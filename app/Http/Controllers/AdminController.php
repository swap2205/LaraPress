<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Theme;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }
    protected $redirectTo = '/admin/dashboard';
    public function redirectTo()
    {
            return route('admin/dashboard');
    }
    public function getLogin(){

        //loading login page from login layout
        $this->theme->setTitle('LMS Admin | Login');
        return $this->theme->layout('login')->of('login')->render();
    }
    public function logout(){
        auth('admin')->logout();
    }
    public function postLogin(){
        $cred = request()->validate([
            'email'=>['required','email:rfc,dns'],
            'password' => ['required','min:6','max:20']
        ]);

        if(Auth::guard('admin')->attempt($cred)){
            return redirect()->intended('/admin/dashboard');
        }
    }


    public function getDashboard(){

        dd(auth('admin')->user());
        $this->theme->setTitle('LMS Dashboard');
        $this->theme->asset()->serve('datatables');
        return $this->theme->of('dashboard')->render();
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
