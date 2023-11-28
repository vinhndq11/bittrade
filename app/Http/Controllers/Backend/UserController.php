<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Datatable;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->logMethods = ['store', 'destroy', 'update'];
        view()->share('roles', Role::query()->latest()->get());
        view()->share('permissions', Permission::query()->latest()->get());
    }

    public function getProfile()
    {
        $mainData = Auth::user();
        $isProfile = true;
        return view("backend.$this->viewFolder.form",compact('mainData', 'isProfile'));
    }

    public function datatable()
    {
        Datatable::getInstance()->builder = Datatable::getInstance()
            ->initBuilder($this->query->select('*')->with('roles', 'permissions'))
            ->addRawColumns(['permissions', 'roles'])
            ->setActionColumn($this->viewFolder, function (User $value){
                if(!hasRoleSuperAdminAndEtc() || $value->isA(SUPERADMINISTRATOR)){
                    return '<i class="fa fa-ban"></i>';
                }
                return view('backend.layout.component.button', [
                    'edit' => route("admin.{$this->viewFolder}.edit", $value->id ?? 0),
                    'delete' => [
                        'url' => route("admin.{$this->viewFolder}.show", $value->id ?? 0),
                        'text' => $value->name ?? $value->id
                    ]
                ]);
            })
            ->getBuilder()
            ->addColumn('permissions', function (User $value){
                if(!hasRoleSuperAdminAndEtc() || $value->isA(SUPERADMINISTRATOR)){
                    return '<i class="fa fa-ban"></i>';
                }
                return "<a type='button' href='" .route("admin.$this->viewFolder.edit", $value->id) . "#tab_permission'
                                       class='btn btn-sm btn-warning'>{$value->permissions()->count()}</a>";
            })
            ->addColumn('roles', function (User $value){
                if(!hasRoleSuperAdminAndEtc() || $value->isA(SUPERADMINISTRATOR)){
                    return '<i class="fa fa-ban"></i>';
                }
                return "<a type='button' href='" .route("admin.$this->viewFolder.edit", $value->id) . "#tab_role'
                                       class='btn btn-sm btn-warning'>{$value->roles()->count()}</a>";
            });

        return parent::datatable();
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ];
        $messages = [
            'name.required' => 'Họ tên không được để trống',

            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã tồn tại trong cơ sở dữ liệu',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($validator);

        $pass = trim($request['password']);
        if(!empty($pass) && strlen($pass) < 6)
            return redirect()->back()->withInput()->with('error','Mật khẩu bỏ trống nếu muốn đặt trùng với email hoặc nhập ít nhất 6 kí tự nếu muốn đặt mới');

        $input = $request->all();
        if($user = User::create($input))
        {
            $user->attachRole(ADMINISTRATOR);
            $this->log($user->id);
            return redirect($request->save)->with('success','Đã thêm người dùng thành công!');
        }
        return back()->withInput()->with('error','Đã xảy ra lỗi khi thêm người dùng, vui lòng thử lại!');
    }

    public function destroy($id)
    {
        $model = $this->query->find($id);
        $this->log($id);
        if ($model->forceDelete()){
            return ['success' => true, 'message' => "Đã xóa thành công!"];
        }
        return ['status' => false, 'message' => "Đã xảy ra lỗi trong quá trình xóa đối tượng, vui lòng thử lại sau!"];
    }

    public function update(Request $request, $user_id)
    {
        if(getAuthUser()->id != $user_id)
            $this->checkRole();

        $user = User::find($user_id);

        if($request->has('update_role')){
            return $this->updateRole($user);
        }

        if($request->has('update_permission')){
            return $this->updatePermission($user);
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|email',
        ];
        $messages = [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'name.required' => 'Họ tên không được để trống',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails())
            return back()->withErrors($validator);

        $pass = trim($request->get('password'));
        if(!empty($pass) && strlen($pass) < 6)
            return back()->with('error','Mật khẩu bỏ trống nếu không muốn thay đổi hoặc nhập ít nhất 6 kí tự nếu muốn đổi mới');

        $redirectTo = route("admin.$this->viewFolder.index");
        $user->is_active = $request->get('is_active');
        if($request->get('is_profile'))
        {
            $user = getAuthUser();
            $redirectTo = route('admin.profile.get');
        }

        $email = $request->get('email');
        if(User::where('email', $email)->where('id', '!=', $user->id)->exists())
            return back()->with('error','Email này đã tồn tại trong hệ thống, vui lòng sử dụng email khác');

        if(!empty($pass))
            $user->password = $pass;

        $user->name = $request->get('name');
        $user->email = $email;
        $user->phone = $request->get('phone');
        $user->birthday = $request->get('birthday');
        $user->gender = $request->get('gender');
        if($user->save()) {
            $this->log($user->id);
            return redirect($redirectTo)->with('success','Đã cập nhật thông tin thành công!');
        }
        return back()->with('error','Đã xảy ra lỗi khi cập nhật thông tin người dùng, vui lòng thử lại!');
    }

    private function updateRole(User $user){
        if(\request('update_role',0)){
            $user->attachRole(\request('id'));
        } else{
            $user->detachRole(\request('id'));
        }
        return responseJSON_EMPTY_OBJECT(true, 'Cập nhật vai trò thành công');
    }

    private function updatePermission(User $user){
        if(\request('update_permission',0)){
            $user->attachPermission(\request('id'));
        } else{
            $user->detachPermission(\request('id'));
        }
        return responseJSON_EMPTY_OBJECT(true, 'Cập nhật quyền thành công');
    }
}
