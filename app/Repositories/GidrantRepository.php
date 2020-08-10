<?php


namespace App\Repositories;


use App\Models\Gidrant as Model;

/**
 * Create a class GidrantRepository.
 *
 *@package App/Repositories
 */
class GidrantRepository extends CoreRepository
{
    /**
     *
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string $zavod
     * @return Model
     */
    public function getIndex($zavod)
    {
        $pole = ['id','user_id','zavod','objekt', 'opisanie','file','updated_at']; //поля обязательны
        return $this->startConditions()->select($pole) //такой запрос уменьшает число обращений к базе
        ->where('zavod', $zavod)      //много запросов связано с тем, что я вывожу имя пользователя кто создал ОП в вьюшке
        ->orderBy('objekt', 'asc')
            ->with(['user:id,firstname']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
            //->toBase() //не создает модели
            ->get(); //для этого необходимо в соответствующей модели создать метод user
    }

    /**
     * Выборка всех удаленных объектов
     *
     *
     * @return Model
     */
    public function getRestoreIndex()
    {
        //$pole = ['id','user_id','zavod','objekt', 'opisanie','file','updated_at', 'deleted_at']; //поля обязательны
        return $this->startConditions()->onlyTrashed() //такой запрос показывает только удаленные записи
        ->orderBy('deleted_at', 'desc')
            ->with(['user:id,firstname']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
            //->toBase() //не создает модели
            ->get(); //для этого необходимо в соответствующей модели создать метод user
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int $id
     * @return Model
     */
    public function getForShowEditUpdate($id)
    {
        return $this->startConditions()->find($id);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  int $id
     * @return Model
     */
    public function getForForseDelete($id)
    {
        //$pole = ['id','user_id','zavod','objekt', 'opisanie','file','updated_at', 'deleted_at']; //поля обязательны
        return $this->startConditions()->onlyTrashed()
            ->where('id', $id)
            ->first();
    }
}
