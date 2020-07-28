<?php

namespace App\Http\Controllers\Naftan;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
use App\Models\Gidrant;
use App\Repositories\GidrantRepository;
use App\Services\FileServise;

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
     * @param GidrantRepository $gidrantRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(GidrantRepository $gidrantRepository)
    {
        $colums = $gidrantRepository->getIndex('Нафтан');
        if (empty($colums)){
            abort(404);
        }
        $zavod = 'naftan';
        $gde = 'ОАО "Нафтан"';
        return view('gidrant.gidrans', compact( 'colums', 'zavod', 'gde'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
    public function store(OperplanCreateRequest $request, FileServise $fileServise)
    {
        $data = $request->all();
        $item = new Gidrant($data);
        $item->file = $fileServise->saveFile($request->file('inputFile'));
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
     * @param GidrantRepository $gidrantRepository
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(GidrantRepository $gidrantRepository, $id)
    {
        $item = $gidrantRepository->getForShowEditUpdate($id);
        if (empty($item)){
            abort(404);
        }
        $icon_map = '{ iconUrl: "/img/marker-icon_pg.png",
                                                iconRetinaUrl:"/img/marker-icon_pg-2x.png",
                                                shadowUrl:"/img/marker-shadow.png",
                                                iconSize:[25,41],
                                                iconAnchor:[12,41],
                                                popupAnchor:[1,-34],
                                                tooltipAnchor:[16,-28],
                                                shadowSize:[41,41]}';
        $link = 'Пожарный гидрант';
        $datamap_pg = "{x: \"$item->pos_x\", y:\"$item->pos_y\", note: '<center><b>$item->objekt</b><br/></center><a href=\"$item->file\" target=\"blank\">$link</a>'}";
        $zavodlink = 'Нафтан';
        return view('gidrant.gidrants_show',compact( 'datamap_pg', 'zavodlink', 'icon_map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GidrantRepository $gidrantRepository
     * @param int $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(GidrantRepository $gidrantRepository, $id)
    {
        $colums = $gidrantRepository->getForShowEditUpdate($id);
        if (empty($colums)){
            abort(404);
        }
        $zavodlink = 'naftan';
        return view('gidrant.gidrans_edit',compact( 'colums', 'zavodlink'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param OperplanUpdateRequest $request
     * @param GidrantRepository $gidrantRepository
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperplanUpdateRequest $request, GidrantRepository $gidrantRepository, FileServise $fileServise, $id)
    {
      //  dd(__METHOD__, $id, request()->all());
        $item = $gidrantRepository->getForShowEditUpdate($id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }
        $data = $request->all();
        if ($request->hasFile('inputFile')){
            $data['file'] = $fileServise->saveFile($request->file('inputFile'));
        }
        $result = $item->update($data);
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
                ->with(["success" => "Запись ID=[{$id}] удалена. Для восстановления или окончательного удаления перейдите по ссылке 'Восстановить объект' в меню пользователя."]);
            /* return back()->with(['success' => 'Запись удалена', 'id' => $id]);*/
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }

    }

    /**
     * Восстановление оперпланов
     *
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = Gidrant::onlyTrashed()
            ->where('id', $id)
            ->restore();//это восстановление
        if ($result){
            return redirect()
                ->route('gidrant.naftan.index')
                ->with(["success" => "Запись ID=[{$id}] восстановлена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка восстаносления.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param GidrantRepository $gidrantRepository
     * @param FileServise $fileServise
     * @return string
     */
    public function softdestroy($id, GidrantRepository $gidrantRepository, FileServise $fileServise)
    {

        $item = $gidrantRepository->getForForseDelete($id);
        //dd($item);
        $item->forceDelete();//это удаление
        if ($item){
            $fileServise->deleteFile($item->file);
            return redirect()
                ->route('restore.index')
                ->with(["success" => "Запись ID=[{$id}] удалена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления.']);
        }
    }

}
