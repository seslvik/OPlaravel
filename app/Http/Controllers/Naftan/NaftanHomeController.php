<?php

namespace App\Http\Controllers\Naftan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NaftanHomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('naftan');
    }
}