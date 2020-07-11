<?php

namespace App\Http\Controllers\Naftan;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
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
        $gde = 'ОАО "Нафтан"';
        return view('operplan.operplans', compact( 'colums', 'zavod', 'gde'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zavod = 'Нафтан';
        return view('operplan.operplans_create',compact( 'zavod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OperplanCreateRequest $request)
    {
        $data = $request->all();
        $item = new Operplan($data);
        $item->user_id = auth()->id();
        $item->zavod = 'Нафтан';
        //dd($item);
        $item->save();
        if ($item){
            return redirect()
                ->route('operplan.naftan.create')
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['msg'=> 'Ошибка сохранения'])
                ->withInput();
        }
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
        //$icon = 'Нафтан';
        return view('operplan.operplans_edit',compact( 'colums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(OperplanUpdateRequest $request, $id) //OperplanUpdateRequest это для валидации данных
    {
        //dd(__METHOD__, $id, request()->all());
        $item = Operplan::find($id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result){
            return redirect()
                ->route('operplan.naftan.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else{
            return back()
                ->withErrors(['msg'=> 'Ошибка сохранения'])
                ->withInput();
        }

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
