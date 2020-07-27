<?php

namespace Modules\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\Entities\AdminAuth;
use Modules\Auth\Entities\AdminPermission;
use Modules\Auth\Entities\AdminRole;
use Swap2205\LaraCRUD\GetDatatables;
use Theme;

class AdminAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    // use GetDatatables;

    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }

    protected $redirectTo = '/admin/dashboard';

    public function redirectTo()
    {
            return route('admin/dashboard');
    }

    public function index(){

        //loading login page from login layout
        $this->theme->setTitle('LMS Admin | Login');
        return $this->theme->layout('login')->of('auth::admin.login')->render();
    }

    public function logout(){
        auth('admin')->logout();
        return redirect()->route('admin.login');
    }
    public function postLogin(){
        $cred = request()->validate([
            'email'=>['required','email:rfc,dns'],
            'password' => ['required','min:6','max:20']
        ]);



        if(Auth::guard('admin')->attempt($cred)){
            return redirect()->intended('/admin/dashboard');
        }
        else{
            return "Invalid email/password";
        }
    }

    //Display admin dashboard
    public function getDashboard(){
        $user = auth('admin')->user();

        // to check the role
        // dd($user->hasRole('admin','moderator','developer'));

        // to check the permission
        // dd($user->can('edit-users'));

        // return ($user->roles);
        $this->theme->setTitle('LMS Dashboard');
        // $this->theme->asset()->serve('datatables');
        return $this->theme->of('auth::admin.dashboard')->render();
    }

    public function list($type=''){
        $this->theme->setTitle('Admin Users')
                    ->asset()->serve('datatables');

        return $this->theme->of('auth::admin.users')->render();
    }

    public function ajax_list(Request $request){
        dd($request);
        $columns = ['email', 'name'];
        //return $columns;
        // $total = AdminAuth::count();

        // initiate the query here
        $query = AdminAuth::select('id','email','name');

        //get the result from trait
        $result = $this->get_data_query($query,$columns);

        $data = [];
        foreach ($result['result'] as $key => $value) {
            $row = [];
            $row[] = $value->email;
            $row[] = $value->name;
            $row[] = "
            <a href='javascript:void(0);' onclick='crud_view({$value->id})' class='btn btn-sm btn-info'><i class='fa fa-eye'></i></i> View</a>
            <a href='javascript:void(0);' onclick='crud_edit({$value->id})' class='btn btn-sm btn-primary'><i class='fa fa-pen'></i></i> Edit</a>
            <a href='javascript:void(0);' onclick='crud_delete({$value->id})' class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></i> Delete</a>
            ";
            $data[] = $row;
        }


        return [
            "draw"=>intval($request->input('draw')),
            "recordsTotal"=>intval($result['total_results']),
            "recordsFiltered"=>intval($result['total_results']),
            "data"=>$data
        ];

    }

    // custom datatable filters - controller specific - to be used with the GetDatatables Trait
    protected function get_filters($query){
        if(request()->input('is_super')!=''){
            $query = $query->where('is_super',request()->input('is_super'));
        }
        return $query;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $user = Auth::guard('admin')->user();
        dd($user);
        //return view('auth::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */



    public function setroles(){
        $dev_permission = AdminPermission::where('slug','create-tasks')->first();
		$manager_permission = AdminPermission::where('slug', 'edit-tasks')->first();

		//RoleTableSeeder.php
		$dev_role = new AdminRole();
		$dev_role->slug = 'developer';
		$dev_role->name = 'Front-end Developer';
		$dev_role->save();
		$dev_role->permissions()->attach($dev_permission);

		$manager_role = new AdminRole();
		$manager_role->slug = 'manager';
		$manager_role->name = 'Assistant Manager';
		$manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

		$dev_role = AdminRole::where('slug','developer')->first();
		$manager_role = AdminRole::where('slug', 'manager')->first();

		$createTasks = new AdminPermission();
		$createTasks->slug = 'create-tasks';
		$createTasks->name = 'Create Tasks';
		$createTasks->save();
		$createTasks->roles()->attach($dev_role);

		$editUsers = new AdminPermission();
		$editUsers->slug = 'edit-users';
		$editUsers->name = 'Edit Users';
		$editUsers->save();
		$editUsers->roles()->attach($manager_role);

		$dev_role = AdminRole::where('slug','developer')->first();
		$manager_role = AdminRole::where('slug', 'manager')->first();
		$dev_perm = AdminPermission::where('slug','create-tasks')->first();
		$manager_perm = AdminPermission::where('slug','edit-users')->first();

		$developer = new AdminAuth();
		$developer->name = 'Swapnil M.';
		$developer->email = 'skm@gmail.com';
		$developer->password = bcrypt('swapnil');
		$developer->save();
		$developer->roles()->attach($dev_role);
		$developer->permissions()->attach($dev_perm);

		$manager = new AdminAuth();
		$manager->name = 'Anil Kumar';
		$manager->email = 'anilv@gmail.com';
		$manager->password = bcrypt('kumar');
		$manager->save();
		$manager->roles()->attach($manager_role);
		$manager->permissions()->attach($manager_perm);


		return redirect()->back();
    }
}
