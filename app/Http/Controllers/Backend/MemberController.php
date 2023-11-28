<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;
use App\Models\MemberTransaction;

class MemberController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->logMethods = ['store', 'destroy', 'update'];
    }

    public function datatable()
    {
        Datatable::getInstance()->builder = Datatable::getInstance()
            ->initBuilder($this->query->with('ref'))
            ->getBuilder()
            ->addColumns(['demo_balance', 'real_balance', 'user_mode_label']);
        return parent::datatable();
    }

    public function postRecharge($member_id)
    {
        MemberTransaction::create([
            'member_id' => $member_id,
            'point_type' => request('data_type'),
            'transaction_type' => TRANSACTION_TYPE_RECHARGE,
            'transaction_status' => TRANSACTION_STATUS_FINISH,
            'value' => request('amount')
        ]);
        return responseJSON_EMPTY_OBJECT(true, 'Nạp tiền thành công!');
    }
}
