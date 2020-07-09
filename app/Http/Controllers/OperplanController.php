<?php

namespace App\Http\Controllers;

use App\Models\Operplan;
use Illuminate\Http\Request;

class OperplanController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //здесь вывести таблицу со всеми оперпланами нафтана или полимира. Скорее всего необходимо контроллеры разбить по папкам
        //Нафтан и полимир, а не Оперплан и Гидрант. А уже  в Нафтане или Полимире делать Гидрант и Оперплан
       return view('operplan.operplans');
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $colums = Operplan::where('zavod', $id ) //здесь надо показать маркер оперплана на карте в зависимости от id открыть карту Нафтана или Полимира
            ->orderBy('objekt', 'asc')
            ->get();
        return view('operplan.operplans', compact( 'colums'));
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
