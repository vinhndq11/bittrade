<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;
use App\Models\MemberTransaction;

class MemberTransactionController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->logMethods = ['postConfirm', 'destroy', 'update'];
    }

    public function datatable()
    {
        $query = $this->query->with('member')
            ->when(empty(request('order')[0]['column']), function ($query){
                return $query->latest();
            })
            ->when(request('point_type'), function ($query, $point_type){
                return $query->where('point_type', $point_type);
            })
            ->when(request('transaction_type'), function ($query, $transaction_type){
                return $query->where('transaction_type', $transaction_type);
            })
            ->when(request('member_id'), function ($query, $member_id){
                return $query->where('member_id', $member_id);
            })
            ->when(request('transaction_status'), function ($query, $transaction_status){
                return $query->where('transaction_status', $transaction_status);
            });
        Datatable::getInstance()->builder = Datatable::getInstance()
            ->ignoreEdit()
            ->initBuilder($query)
            ->setActionColumn(null, function ($value){
                return view('backend.layout.component.button', [
                    'delete' => [
                        'url' => route("admin.{$this->viewFolder}.show", $value->id ?? 0),
                        'text' => $value->name ?? $value->title ?? $value->id
                    ],
                    'confirm' => $value->transaction_status == TRANSACTION_STATUS_PENDING ? route('admin.member_transaction.confirm.post', ['id' => $value->id]) : null,
                    'detail' => route('admin.member_transaction.show', ['id' => $value->id])
                ]);
            })
            ->getBuilder()
            ->addColumns(['point_type_label', 'transaction_type_label', 'transaction_status_label']);
        return parent::datatable();
    }

    public function postConfirm($id)
    {
        $memberTransaction = MemberTransaction::find($id);
        if(!$memberTransaction || $memberTransaction->transaction_status != TRANSACTION_STATUS_PENDING){
            return responseJSON_EMPTY_OBJECT(false, 'Giao dịch này đã bị xóa hoặc được duyệt trước đó!');
        }

        $action = request('action');
        if($action == 'accept'){
            $this->log($id, "Duyệt xong: {$memberTransaction->code}");
            $memberTransaction->update(['transaction_status' => TRANSACTION_STATUS_FINISH]);
            return responseJSON_EMPTY_OBJECT(true, 'Đã phê duyệt xong giao dịch này!');
        }
        if($action == 'cancel'){
            $this->log($id, "Hủy bỏ {$memberTransaction->code}");
            $memberTransaction->update(['transaction_status' => TRANSACTION_STATUS_CANCEL]);
            return responseJSON_EMPTY_OBJECT(true, 'Đã hủy bỏ giao dịch này!');
        }
        return responseJSON_EMPTY_OBJECT(false, 'Lệnh không đúng!');
    }

    public function show($id)
    {
        $item = $this->query->find($id);
        return responseJSON(['view' => view('backend.member_transaction.show', compact('item'))->render()]);
    }
}
