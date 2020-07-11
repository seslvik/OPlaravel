<?php

namespace App\Http\Controllers\Polymir;

use App\Http\Controllers\Controller;
use App\Models\Operplan;
use Illuminate\Http\Request;

class PolimirOperplanController extends Controller
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
        $colums = Operplan::where('zavod', 'Полимир' )
            ->orderBy('objekt', 'asc')
            ->get();
        $zavod = 'polymir';
        $gde = 'завода "Полимир" ОАО "Нафтан"';
        return view('operplan.operplans', compact( 'colums', 'zavod', 'gde'));
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $colums = Operplan::findOrFail($id );
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
