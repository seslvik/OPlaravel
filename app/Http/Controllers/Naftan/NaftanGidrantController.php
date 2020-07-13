<?php

namespace App\Http\Controllers\Naftan;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
use App\Models\Gidrant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NaftanGidrantController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colums = Gidrant::where('zavod', 'Нафтан' )
            ->orderBy('objekt', 'asc')
            ->get();
        $zavod = 'naftan';
        $gde = 'ОАО "Нафтан"';
        return view('gidrant.gidrans', compact( 'colums', 'zavod', 'gde'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $zavod = 'Нафтан';
        $zavodlink = 'naftan';
        return view('gidrant.gidrans_create',compact( 'zavod', 'zavodlink'));

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
        if ($request->hasFile('inputFile')){
            $ras = $request->file('inputFile')->extension();
            $path = $request->file('inputFile')->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            $data['file'] = $url;
        }
        $item = new Gidrant($data);
        $item->user_id = auth()->id();
        $item->zavod = 'Нафтан';
        $item->save();
        if ($item){
            return redirect()
                ->route('gidrant.naftan.create')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $colums = Gidrant::findOrFail($id);
        $zavodlink = 'naftan';
        return view('gidrant.gidrans_edit',compact( 'colums', 'zavodlink'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(OperplanUpdateRequest $request, $id)
    {
      //  dd(__METHOD__, $id, request()->all());
       // $id =55555;
        $item = Gidrant::find($id);
        //dd($item);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }

        $data = $request->all();
        //dd($data);
        if ($request->hasFile('inputFile')){
            $ras = $request->file('inputFile')->extension();
            $path = $request->file('inputFile')->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            $data['file'] = $url;
        }

        $result = $item->update($data);
        //dd($result);
        if ($result){
            return redirect()
                ->route('gidrant.naftan.edit', $item->id)
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

        $result = Gidrant::destroy($id);//это мягкое удаление (записывается дата в поле deleted_at
        //$user->restore(); //восстановить запись
        //$operplan->forceDelete(); это окончательно удалит запись из базы данных

        if ($result){
            return redirect()
                ->route('gidrant.naftan.index')
                ->with(["success" => "Запись ID=[{$id}] удалена."]);
            /* return back()->with(['success' => 'Запись удалена', 'id' => $id]);*/
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }

    }
}
