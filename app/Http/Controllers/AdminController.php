<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/admin/index');
    }

    /**
     * Show the form for creating a new resource.
     *中间
     * @return \Illuminate\Http\Response
     */
    public function main()
    {
         return view('/admin/main');
    }

    /**
     * Store a newly created resource in storage.
     *头部
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function head()
    {
        return view('/admin/head');
    }

    /**
     * Display the specified resource.
     *左边
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function left()
    {
         return view('/admin/left');
    }

   
}
