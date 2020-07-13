<?php

namespace App\Http\Controllers\Polymir;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
use App\Models\Operplan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $zavod = 'Полимир';
        $zavodlink = 'polymir';
        return view('operplan.operplans_create',compact( 'zavod', 'zavodlink'));

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
        $item = new Operplan($data);
        $item->user_id = auth()->id();
        $item->zavod = 'Полимир';
        $item->save();
        if ($item){
            return redirect()
                ->route('operplan.polymir.create')
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $colums = Operplan::findOrFail($id );
        $zavodlink = 'polymir';
        return view('operplan.operplans_edit',compact( 'colums', 'zavodlink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperplanUpdateRequest $request, $id)
    {
        $item = Operplan::find($id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }
        $data = $request->all();
        if ($request->hasFile('inputFile')){
            $ras = $request->file('inputFile')->extension();
            $path = $request->file('inputFile')->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            $data['file'] = $url;
        }
        $result = $item->update($data);
        if ($result){
            return redirect()
                ->route('operplan.polymir.edit', $item->id)
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
        $result = Operplan::destroy($id);
        if ($result){
            return redirect()
            ->route('operplan.polymir.index')
                ->with(["success" => "Запись ID=[{$id}] удалена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }
    }
}