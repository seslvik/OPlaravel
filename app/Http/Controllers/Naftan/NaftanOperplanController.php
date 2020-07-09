<?php

namespace App\Http\Controllers\Naftan;

use App\Http\Controllers\Controller;
use App\Models\Operplan;
use Illuminate\Http\Request;

class NaftanOperplanController extends Controller
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
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {

        $colums = Operplan::where('zavod', 'Нафтан' )
        ->orderBy('objekt', 'asc')
            ->get();
        $zavod = 'naftan';
        return view('operplan.operplans', compact( 'colums', 'zavod'));
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
        //здесь надо показать маркер оперплана на карте в зависимости от id открыть карту Нафтана или Полимира
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {

        $colums = Operplan::findOrFail($id);
            //->orderBy('objekt', 'asc')
            //->get();
        //dd($colums);
        return view('operplan.operplans_edit',compact( 'colums'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //dd(__METHOD__, $id, request()->all());
        $result = Operplan::destroy($id);//это мягкое удаление (записывается дата в поле deleted_at
        //$user->restore(); //восстановить запись
        //$operplan->forceDelete(); это окончательно удалит запись из базы данных

        if ($result){
            /*return redirect()
                ->route('operplan.operplans')
                ->with(['success' => 'Запись удалена']);*/
            return back()->with(['success' => 'Запись удалена', 'id' => $id]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }
    }
}
