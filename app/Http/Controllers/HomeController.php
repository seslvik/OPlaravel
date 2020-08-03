<?php

namespace App\Http\Controllers;

use App\Models\Gidrant;
use App\Models\Operplan;
use App\Models\Polygon;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $operplan_count = Operplan::count();
        $gidrant_count = Gidrant::count();
        $object_count = Polygon::count();
        //dd($operplan_count, $gidrant_count, $object_count);
        return view('home', compact('operplan_count', 'gidrant_count', 'object_count'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('home');
    }


}
