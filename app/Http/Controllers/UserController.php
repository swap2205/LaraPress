<?php

namespace App\Http\Controllers;

use Theme;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $theme;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->theme = Theme::uses('admin');
    }

    public function getLogin(){

        //loading login page from login layout
        $this->theme->setTitle('LMS Admin | Login');
        return $this->theme->layout('login')->of('login')->render();
    }

    public function postLogin(){
        dd(request()->validate([
            'email'=>['required','email:rfc,dns'],
            'pass' => ['required','min:6','max:20']
        ]));
    }

    public function getDashboard(){
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
