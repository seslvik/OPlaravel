<?php

namespace App\Http\Controllers\Polymir;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolygonCreateRequest;
use App\Http\Requests\PolygonUpdateRequest;
use App\Models\Polygon;

class PolymirPolygonController extends Controller
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
        $colums = Polygon::where('zavod', 'Полимир' )
            ->orderBy('opisanie', 'asc')
            ->get();
        $zavod = 'polymir';
        $gde = 'завода "Полимир" ОАО "Нафтан"';
        return view('polygon.polygons', compact( 'colums', 'zavod', 'gde'));
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
        return view('polygon.polygons_create',compact( 'zavod', 'zavodlink'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PolygonCreateRequest $request)
    {
        $data = $request->all();
        $item = new Polygon($data);
        $item->user_id = auth()->id();
        $item->zavod = 'Полимир';
        $item->save();
        if ($item){
            return redirect()
                ->route('polygon.polymir.create')
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
        $colums = Polygon::findOrFail($id);
        $zavodlink = 'polymir';

        return view('polygon.polygons_edit',compact( 'colums', 'zavodlink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PolygonUpdateRequest $request, $id)
    {
        $item = Polygon::find($id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }
        $data = $request->all();
        $result = $item->update($data);
        if ($result){
            return redirect()
                ->route('polygon.polymir.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        }else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
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
        $result = Polygon::destroy($id);//это мягкое удаление (записывается дата в поле deleted_at
        if ($result){
            return redirect()
                ->route('operplan.polymir.index')
                ->with(["success" => "Запись ID=[{$id}] удалена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }
    }
}
