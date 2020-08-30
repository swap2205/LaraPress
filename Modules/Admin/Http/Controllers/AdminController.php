<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\Admin;
use Swap2205\LaraCRUD\LaraCRUDCMS;
use Theme;

class AdminController extends Controller
{
    // use GetDatatables;

    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(LaraCRUDCMS $crud)
    {
        $this->theme->setTitle('Admin Users')
                    ->asset()->serve('datatables');

        $data = $crud->initList(Admin::class)->setPageTitle("Users")->getViewData();

        $data['datatable_url'] = '/admin/users/list';
        $data['form_submit_url'] = '/admin/users';
//        return $data;
        return $this->theme->of('admin::users',$data)->render();
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
    }

	
    public function ajax_list(Request $request){
        $query = Admin::select('id');
        // $query = $this->get_filters($query);
        $crud = new LaraCRUDCMS();
        $result = $crud->initDatatable(Admin::class)->getDataTable($query);

        return $result;
    }

/*    public function ajax_list(Request $request){
        // dd($request);
        $columns = ['email', 'name'];
        //return $columns;
        // $total = AdminAuth::count();

        // initiate the query here
        $query = Admin::select('id','email','name');

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
*/ 
    public function store(Request $request)
    {
        $data = $request->validate([
            'email'=>'required|email:rfc,dns|unique:admin_users,email',
            'password' => 'required|min:6',
            'name' =>'required',
            'is_super'=> 'numeric'
        ]);
        // dd($data);
        $user = new Admin();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->is_super = $request->input('is_super') ? 1 : 0;
        $stat = $user->save();
        return [
            'status' => $stat,
            'user'=>$user
        ];
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show(Admin $user)
    {
        $user->is_super = $user->is_super ? 'Yes' : 'No';
        $user->created_at = date('d-m-Y',strtotime($user->created_at));
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(Admin $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, Admin $user)
    {
        $data = $request->validate([
            // 'email'=>'required|email:rfc,dns|unique:admin_users,email',
            'email'=>'required|email:rfc,dns',
            'name' =>'required',
            'is_super'=> 'numeric'
        ]);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->is_super = $request->input('is_super') ? 1 : 0;
        $status = $user->save();

        return [
            'status'=> $status,
            'user' => $user
        ];

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
