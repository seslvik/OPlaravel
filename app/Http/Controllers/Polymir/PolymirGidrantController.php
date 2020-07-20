<?php

namespace App\Http\Controllers\Polymir;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperplanCreateRequest;
use App\Http\Requests\OperplanUpdateRequest;
use App\Models\Gidrant;
use App\Services\FileServise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PolymirGidrantController extends Controller
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
        /*$colums = Gidrant::where('zavod', 'Полимир' )
            ->orderBy('objekt', 'asc')
            ->get();*/

        $pole = ['id','user_id','zavod','objekt', 'opisanie','file','updated_at']; //полч обязательны
        $colums = Gidrant::select($pole) //такой запрос уменьшает число обращений к базе
        ->where('zavod', 'Полимир')      //много запросов связано с тем, что я вывожу имя пользователя кто создал ОП в вьюшке
        ->orderBy('objekt', 'asc')
            ->with(['user:id,name']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
            ->get(); //для этого необходимо в соответствующей модели создать метод user


        $zavod = 'polymir';
        $gde = 'завода "Полимир" ОАО "Нафтан"';
        return view('gidrant.gidrans', compact( 'colums', 'zavod', 'gde'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $zavod = 'Полимир';
        $zavodlink = 'polymir';
        return view('gidrant.gidrans_create',compact( 'zavod', 'zavodlink'));

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
        $item = new Gidrant($data);
        $item->file = $fileServise->saveFile($request->file('inputFile'));
        $item->user_id = auth()->id();
        $item->zavod = 'Полимир';
        $item->save();
        if ($item){
            return redirect()
                ->route('gidrant.polymir.create')
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $item = Gidrant::findOrFail($id);
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
        $zavodlink = 'Полимир';
        return view('gidrant.gidrants_show',compact( 'datamap_pg', 'zavodlink', 'icon_map'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $colums = Gidrant::findOrFail($id );
        $zavodlink = 'polymir';
        return view('gidrant.gidrans_edit',compact( 'colums', 'zavodlink'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param OperplanUpdateRequest $request
     * @param FileServise $fileServise
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OperplanUpdateRequest $request,  FileServise $fileServise, $id)
    {
        $item = Gidrant::find($id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }
        $data = $request->all();
        //обработка файла вынесена в Сервис класс $fileServise
        if ($request->hasFile('inputFile')){
            $data['file'] = $fileServise->saveFile($request->file('inputFile'));
        }
        $result = $item->update($data);
        if ($result){
            return redirect()
                ->route('gidrant.polymir.edit', $item->id)
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
        $result = Gidrant::destroy($id);
        if ($result){
            return redirect()
                ->route('gidrant.polymir.index')
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
        $result = Gidrant::onlyTrashed()
            ->where('id', $id)
            ->restore();//это восстановление
        if ($result){
            return redirect()
                ->route('gidrant.polymir.index')
                ->with(["success" => "Запись ID=[{$id}] восстановлена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка восстаносления.']);
        }
    }

}
