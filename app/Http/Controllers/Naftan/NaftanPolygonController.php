<?php

namespace App\Http\Controllers\Naftan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PolygonCreateRequest;
use App\Http\Requests\PolygonUpdateRequest;
use App\Models\Polygon;
use App\Repositories\PolygonRepository;

class NaftanPolygonController extends Controller
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
    public function index(PolygonRepository $polygonRepository)
    {
        /*$colums = Polygon::where('zavod', 'Нафтан' )
            ->orderBy('opisanie', 'asc')
            ->get();*/
        $colums = $polygonRepository->getIndex('Нафтан');
        /*$pole = ['id','user_id','zavod','opisanie','updated_at']; //полч обязательны
        $colums = Polygon::select($pole) //такой запрос уменьшает число обращений к базе
        ->where('zavod', 'Нафтан')      //много запросов связано с тем, что я вывожу имя пользователя кто создал ОП в вьюшке
        ->orderBy('opisanie', 'asc')
            ->with(['user:id,name']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
            ->get(); //для этого необходимо в соответствующей модели создать метод user*/


        $zavod = 'naftan';
        $gde = 'ОАО "Нафтан"';
        return view('polygon.polygons', compact( 'colums', 'zavod', 'gde'));

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
        $item->zavod = 'Нафтан';
        $item->save();
        if ($item){
            return redirect()
                ->route('polygon.naftan.create')
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
        $item = Polygon::findOrFail($id);
        $opisanie = $item->opisanie;
        $color = $item->color;
        $pos_x_1 = $item->pos_x_1;
        $pos_y_1 = $item->pos_y_1;
        $pos_x_2 = $item->pos_x_2;
        $pos_y_2 = $item->pos_y_2;
        $pos_x_3 = $item->pos_x_3;
        $pos_y_3 = $item->pos_y_3;
        $pos_x_4 = $item->pos_x_4;
        $pos_y_4 = $item->pos_y_4;
        $pos_x_5 = $item->pos_x_5;
        $pos_y_5 = $item->pos_y_5;
        $pos_x_6 = $item->pos_x_6;
        $pos_y_6 = $item->pos_y_6;
        $pos_x_7 = $item->pos_x_7;
        $pos_y_7 = $item->pos_y_7;
        $pos_x_8 = $item->pos_x_8;
        $pos_y_8 = $item->pos_y_8;
        $datamap_pol = "{x1: \"$pos_x_1\", y1:\"$pos_y_1\", x2: \"$pos_x_2\", y2:\"$pos_y_2\", x3: \"$pos_x_3\", y3:\"$pos_y_3\",
           x4: \"$pos_x_4\", y4:\"$pos_y_4\", x5: \"$pos_x_5\", y5:\"$pos_y_5\",
           x6: \"$pos_x_6\", y6:\"$pos_y_6\", x7: \"$pos_x_7\", y7:\"$pos_y_7\", x8: \"$pos_x_8\", y8:\"$pos_y_8\", color: \"$color\", note: '<center><b>$opisanie</b><br/></center>'}";
        $zavodlink = 'Нафтан';
        return view('polygon.polygons_show',compact( 'datamap_pol', 'zavodlink'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $colums = Polygon::findOrFail($id);
        $zavodlink = 'naftan';
        $for_pos = [];
        $for_pos['pos_x_1']= $colums->pos_x_1;
        $for_pos['pos_y_1']= $colums->pos_y_1;
        $for_pos['pos_x_2']= $colums->pos_x_2;
        $for_pos['pos_y_2']= $colums->pos_y_2;
        $for_pos['pos_x_3']= $colums->pos_x_3;
        $for_pos['pos_y_3']= $colums->pos_y_3;
        $for_pos['pos_x_4']= $colums->pos_x_4;
        $for_pos['pos_y_4']= $colums->pos_y_4;
        $for_pos['pos_x_5']= $colums->pos_x_5;
        $for_pos['pos_y_5']= $colums->pos_y_5;
        $for_pos['pos_x_6']= $colums->pos_x_6;
        $for_pos['pos_y_6']= $colums->pos_y_6;
        $for_pos['pos_x_7']= $colums->pos_x_7;
        $for_pos['pos_y_7']= $colums->pos_y_7;
        $for_pos['pos_x_8']= $colums->pos_x_8;
        $for_pos['pos_y_8']= $colums->pos_y_8;


       // dd($colums, $for_pos);
        return view('polygon.polygons_edit',compact( 'colums', 'zavodlink', 'for_pos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(PolygonUpdateRequest $request, $id)
    {
        //dd(__METHOD__, $id, request()->all());
        $item = Polygon::find($id);
        if (empty($item)){
            return back()
                ->withErrors(["msg"=> "Запись ID=[{$id}]не найдена"])
                ->withInput();
        }

        $data = $request->all();

        //dd($ras);
        //dd($path, $data, $url);
        $result = $item->update($data);
        // $result = $item->fill($data)->save();

        if ($result){
            return redirect()
                ->route('polygon.naftan.edit', $item->id)
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

        $result = Polygon::destroy($id);//это мягкое удаление (записывается дата в поле deleted_at
        //$user->restore(); //восстановить запись
        //$operplan->forceDelete(); это окончательно удалит запись из базы данных

        if ($result){
            return redirect()
                ->route('polygon.naftan.index')
                ->with(["success" => "Запись ID=[{$id}] удалена. Для восстановления или окончательного удаления перейдите по ссылке 'Восстановить объект' в меню пользователя."]);
            /* return back()->with(['success' => 'Запись удалена', 'id' => $id]);*/
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }

    }


    /**
     * Восстановление оперпланов
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        $result = Polygon::onlyTrashed()
            ->where('id', $id)
            ->restore();//это восстановление
        if ($result){
            return redirect()
                ->route('polygon.naftan.index')
                ->with(["success" => "Запись ID=[{$id}] восстановлена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка восстаносления.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param PolygonRepository $polygonRepository
     * @return string
     */
    public function softdestroy($id, PolygonRepository $polygonRepository)
    {

        $item = $polygonRepository->getForForseDelete($id);
        //dd($item);
        $item->forceDelete();//это удаление
        if ($item){
            return redirect()
                ->route('restore.index')
                ->with(["success" => "Запись ID=[{$id}] удалена."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления.']);
        }
    }

}
