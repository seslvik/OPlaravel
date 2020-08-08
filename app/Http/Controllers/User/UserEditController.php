<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function index()
    {
        if (Auth::user()->admin == '1'){                     //это проверка на админа
            $pole = ['id','name','email', 'admin', 'activ', 'avatar'];
            $colums = User::select($pole)
                ->orderBy('name', 'asc')
                ->get();
           // dd($colums);
            return view('user.users_edit', compact( 'colums'));
        }
        return abort(404);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('user.user_create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = User::destroy($id);//это мягкое удаление (записывается дата в поле deleted_at
        //$user->restore(); //восстановить запись
        //$operplan->forceDelete(); это окончательно удалит запись из базы данных
        if ($result){
            return redirect()
                ->route('user.admin.index')
                ->with(["success" => "Пользователь ID=[{$id}] удалён."]);
        }else{
            return back()->withErrors(['msg'=> 'Ошибка удаления']);
        }
    }
}
