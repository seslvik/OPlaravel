<?php

namespace App\Http\Controllers\Naftan;

use App\Exports\OperplansExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
use App\Models\Operplan;
use App\Repositories\OperplanRepository;
use App\Services\FileServise;
use Maatwebsite\Excel\Facades\Excel;

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
     *Получаем все оперпланы для вывода в таблицу
     * @param OperplanRepository $operplanRepository
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(OperplanRepository $operplanRepository)
    {
        $colums = $operplanRepository->getIndex('Нафтан');
        if (empty($colums)){
            abort(404);
        }
        $zavod = 'naftan';
        $gde = 'ОАО "Нафтан"';
        return view('operplan.operplans', compact( 'colums', 'zavod', 'gde'));
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
//        dd($data,$item);
        $item->file = $fileServise->saveFile($request->file('inputFile'));
        $item->user_id = auth()->id();
        $item->zavod = 'Нафтан';
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

        $zavodlink = 'Нафтан';
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
            abort(404, 'Страница c ID=['.$id.']не найдена.');
        }
        $zavodlink = 'naftan';
        return view('operplan.operplans_edit',compact( 'colums', 'zavodlink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OperplanUpdateRequest $request
     * @param OperplanRepository $operplanRepository
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperplanUpdateRequest $request, OperplanRepository $operplanRepository, FileServise $fileServise, $id) //OperplanUpdateRequest это для валидации данных
    {
        //dd(__METHOD__, $id, request()->all());

        $item = $operplanRepository->getForShowEditUpdate($id);
       // dd(__METHOD__,$item->id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }
        $data = $request->all();
        //обработка файла вынесена в Сервис класс $fileServise
        if ($request->hasFile('inputFile')){
            $fileServise->deleteFile($item->file); //удаление старого файла
            $data['file'] = $fileServise->saveFile($request->file('inputFile'), $id);
            //dd($data['file'],$item->file );
        }
        /*if ($request->hasFile('inputFile')){
            $ras = $request->file('inputFile')->extension();
            $path = $request->file('inputFile')->storeAs('public', Auth::id() . '_' . date('d_m_Y_H_i_s').'.'.$ras);
            $url = Storage::url($path);
            $data['file'] = $url;
        }*/

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
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //dd(__METHOD__, $id, request()->all());

        /*$item = $operplanRepository->getForShowEditUpdate($id);*///это если удалять без возможности восстановления

        $result = Operplan::destroy($id);//это мягкое удаление (записывается дата в поле deleted_at
        //$user->restore(); //восстановить запись
        //$operplan->forceDelete(); это окончательно удалит запись из базы данных
        if ($result){

            /*$fileServise->deleteFile($item->file);*/ //это если удалять без возможности восстановления

            return redirect()
                ->route('operplan.naftan.index')
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
        $result = Operplan::onlyTrashed()
            ->where('id', $id)
            ->restore();//это восстановление
        if ($result){
            return redirect()
                ->route('operplan.naftan.index')
                ->with(["success" => "Запись ID=[{$id}] восстановлена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка восстаносления.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param OperplanRepository $operplanRepository
     * @param FileServise $fileServise
     * @return string
     */
    public function softdestroy($id, OperplanRepository $operplanRepository, FileServise $fileServise)
    {

        $item = $operplanRepository->getForForseDelete($id);
        //dd($item);
        $item->forceDelete();//это удаление
        if ($item){
            //dd($item->file);
            $fileServise->deleteFile($item->file);
            return redirect()
                ->route('restore.index')
                ->with(["success" => "Запись ID=[{$id}] удалена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления.']);
        }
    }

    public function export()
    {
        return Excel::download(new OperplansExport, 'operplans.xlsx');
    }

}
