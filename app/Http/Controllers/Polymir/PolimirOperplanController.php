<?php

namespace App\Http\Controllers\Polymir;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
use App\Models\Operplan;
use App\Repositories\OperplanRepository;
use App\Services\FileServise;

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
     *Получаем все оперпланы для вывода в таблицу
     * @param OperplanRepository $operplanRepository
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(OperplanRepository $operplanRepository)
    {
        $colums = $operplanRepository->getIndex('Полимир');
        if (empty($colums)){
            abort(404);
        }
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
     * @param OperplanCreateRequest $request
     * @param FileServise $fileServise
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OperplanCreateRequest $request, FileServise $fileServise)
    {
        $data = $request->all();
        $item = new Operplan($data);
        $item->file = $fileServise->saveFile($request->file('inputFile'));
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
     * @param OperplanRepository $operplanRepository
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(OperplanRepository $operplanRepository, $id)
    {
        $item = $operplanRepository->getForShowEditUpdate($id);
        if (empty($item)){
            abort(404);
        }
        $icon_map = '{ iconUrl: "/img/marker-icon.png",
                                                iconRetinaUrl:"/img/marker-icon-2x.png",
                                                shadowUrl:"/img/marker-shadow.png",
                                                iconSize:[25,41],
                                                iconAnchor:[12,41],
                                                popupAnchor:[1,-34],
                                                tooltipAnchor:[16,-28],
                                                shadowSize:[41,41]}';
        $link = 'Оперативный план';
        $datamap_op = "{x: \"$item->pos_x\", y:\"$item->pos_y\", note: '<center><b>$item->objekt</b><br/></center><a href=\"$item->file\" target=\"blank\">$link</a>'}";
        $zavodlink = 'Полимир';
        return view('operplan.operplans_show',compact( 'datamap_op', 'zavodlink', "icon_map"));
    }

    /**
     * Show the form for editing the specified resource.
     * @param OperplanRepository $operplanRepository
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(OperplanRepository $operplanRepository, $id)
    {
        $colums = $operplanRepository->getForShowEditUpdate($id);
        if (empty($colums)){
            abort(404);
        }
        $zavodlink = 'polymir';
        return view('operplan.operplans_edit',compact( 'colums', 'zavodlink'));
    }

    /**
     * Update the specified resource in storage.
     * @param OperplanUpdateRequest $request
     * @param OperplanRepository $operplanRepository
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperplanUpdateRequest $request, OperplanRepository $operplanRepository, FileServise $fileServise, $id)
    {
        $item = $operplanRepository->getForShowEditUpdate($id);
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

    /**
     * Восстановление оперпланов
     *
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = Operplan::onlyTrashed()
            ->where('id', $id)
            ->restore();//это восстановление
        if ($result){
            return redirect()
                ->route('operplan.polymir.index')
                ->with(["success" => "Запись ID=[{$id}] восстановлена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка восстаносления.']);
        }
    }
}
