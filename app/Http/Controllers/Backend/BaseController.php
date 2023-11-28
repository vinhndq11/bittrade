<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;
use App\Helpers\ValidResponse;
use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * show off @property
 *
 * @property BaseModel $mainModel
 * @property BaseModel $query
 */
class BaseController extends Controller
{
    protected $limit;
    protected $user;
    protected $mainModel = null;
    protected $query = null;
    protected $viewFolder = null;
    protected $sync = [];
    protected $attach = [];
    protected $logMethods = [  ];
    protected $validResponse = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->limit = (int)($request->limit ?? 200);
            $this->user = auth()->user();
            if (!$this->user){
                $this->user = new User();
            }
            return $next($request);
        });
        $this->mainModel = $this->viewFolder ?? getModelFromController(get_called_class());
        $this->query = $this->mainModel;
        $this->viewFolder = $this->viewFolder ?? get_view_folder(get_class_name(str_replace('Controller', '', get_called_class())));
        view()->share('viewFolder', $this->viewFolder);

        $this->validResponse = new ValidResponse();

        if(!app()->runningInConsole() && in_array(request()->route()->getActionMethod(), ['datatable'])){
            if (count(optional($this->mainModel)->translatedAttributes ?? [])) {
                $this->query = $this->query->withTranslation();
            }
            Datatable::getInstance()->setMainModel($this->mainModel);
        }

        if(!app()->runningInConsole() && in_array(request()->route()->getActionMethod(), ['store', 'update', 'destroy'])){
            $this->forgetCache();
        }
    }

    public function index()
    {
        return view("backend.$this->viewFolder.list");
    }

    public function datatable()
    {
        return Datatable::getInstance()
            ->initBuilder($this->query)
            ->setActionColumn($this->viewFolder)
            ->setActiveColumn()
            ->setImageColumns()
            ->getDatatable();
    }

    public function create()
    {
        return view("backend.$this->viewFolder.form", ['mainData' => null]);
    }

    public function store(Request $request)
    {
        $this->validStore();
        if($this->validResponse->is_fail){
            return $this->validResponse->getWaring();
        }
        $input = $request->all();
        $mainData = $this->query->create($input);
        foreach ($this->sync as $item){
            $mainData->{$item}()->sync($input[$item] ?? []);
        }
        foreach ($this->attach as $item){
            foreach($input[$item] ?? [] as $value){
                $mainData->{$item}()->create($value ?? []);
            }
        }
        if(method_exists($mainData, 'updateSlug')){
            $mainData->updateSlug();
        }
        if ($mainData){
            $this->log($mainData->id);
            return redirect($request->save)->with('success', 'Đã thêm thông tin đối tượng thành công!');
        }
        return back()->withInput()->with('error', 'Đã xảy ra lỗi khi thêm thông tin đối tượng, vui lòng thử lại!');
    }

    public function show($id)
    {
        $mainData = $this->query->find($id);
        return view("backend.$this->viewFolder.show", compact('mainData'));
    }

    public function edit($id)
    {
        $mainData = $this->query->find($id);
        return view("backend.$this->viewFolder.form", compact('mainData'));
    }

    public function update(Request $request, $id)
    {
        $this->validUpdate($id);
        if($this->validResponse->is_fail){
            return $this->validResponse->getWaring();
        }
        $input = $request->all();
        $mainData = $this->query->find($id);
        $mainData->update($input);
        foreach ($this->sync as $item){
            $mainData->{$item}()->sync($input[$item] ?? []);
        }
        foreach ($this->attach as $item){
            $mainData->{$item}()->delete();
            foreach($input[$item] ?? [] as $value){
                $mainData->{$item}()->create($value ?? []);
            }
        }
        if(method_exists($mainData, 'updateSlug')){
            $mainData->updateSlug();
        }
        if ($mainData){
            $this->log($id);
            return redirect($request->save)->with('success', 'Đã cập nhật thông tin đối tượng thành công!');
        }
        return back()->withInput()->with('error', 'Đã xảy ra lỗi khi cập nhật thông tin đối tượng, vui lòng thử lại!');
    }

    public function destroy($id)
    {
        $model = $this->query->find($id);
        $this->log($id);
        if ($model->delete()){
            return ['success' => true, 'message' => "Đã xóa thành công!"];
        }
        return ['status' => false, 'message' => "Đã xảy ra lỗi trong quá trình xóa đối tượng, vui lòng thử lại sau!"];
    }

    protected function checkRole($roles = [SUPERADMINISTRATOR])
    {
        if (!getAuthUser()->hasRole($roles)){
            abort(403);
        }
        return null;
    }

    protected function forgetCache() {}
    protected function log($model_id, $name = null)
    {
        $method = request()->route()->getActionMethod();
        if(in_array($method, $this->logMethods)){
            $object = optional($this->mainModel->find($model_id));
            $name = $name ?? $object->name ?? $object->username ?? $object->email ?? $object->code ?? $object->title ?? '';
            $model = get_class($this->mainModel);
            Log::create([
                'model' => $model,
                'model_id' => $model_id,
                'user_id' => $this->user->id,
                'method' => $method,
                'ip' => request()->ip(),
                'browser' => request()->userAgent(),
                'message' => $name,
            ]);
            Log::where('created_at', '<', now()->subMonths(3))->delete();
        }
    }
    protected function validStore() {}
    protected function validUpdate($id) {}
}
