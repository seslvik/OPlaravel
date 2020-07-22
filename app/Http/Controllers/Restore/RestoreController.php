<?php

namespace App\Http\Controllers\Restore;

use App\Http\Controllers\Controller;
use App\Repositories\GidrantRepository;
use App\Repositories\OperplanRepository;
use App\Repositories\PolygonRepository;
use Illuminate\Http\Request;

class RestoreController extends Controller
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
     * @param OperplanRepository $operplanRepository
     * @param GidrantRepository $gidrantRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(OperplanRepository $operplanRepository, GidrantRepository $gidrantRepository, PolygonRepository $polygonRepository)
    {
        $operplans = $operplanRepository->getRestoreIndex();
        if (empty($operplans)){
            abort(404);
        }
        $gidrants = $gidrantRepository->getRestoreIndex();
        if (empty($gidrants)){
            abort(404);
        }
        $polygons = $polygonRepository->getRestoreIndex();
        if (empty($polygons)){
            abort(404);
        }
        return view('restore', compact( 'operplans', 'gidrants', 'polygons'));
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
     * @param int $id
     * @param $objekt
     * @param OperplanRepository $operplanRepository
     * @param GidrantRepository $gidrantRepository
     * @param PolygonRepository $polygonRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, $objekt,
                         OperplanRepository $operplanRepository,
                         GidrantRepository $gidrantRepository,
                         PolygonRepository $polygonRepository)
    {
        //dd($id, $objekt);
        if ($objekt === 'operplan'){
            $vid_objekta = 'Оперативный план';
            $colums = $operplanRepository->getForForseDelete($id);
            if (empty($colums)){
                abort(404);
            }
        }
        if ($objekt === 'gidrant'){
            $vid_objekta = 'Пожарный гидрант';
            $colums = $gidrantRepository->getForForseDelete($id);
            if (empty($colums)){
                abort(404);
            }
        }
        if ($objekt === 'polygon') {
            $vid_objekta = 'Объект';
            $colums = $polygonRepository->getForForseDelete($id);
            if (empty($colums)) {
                abort(404);
            }
        }
           // dd($colums->zavod);
        return view('restore_delete',  compact('colums', 'objekt', 'vid_objekta'));

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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Принудительное удаление одного экземпляра модели...
        //$flight->forceDelete();
    }
}
