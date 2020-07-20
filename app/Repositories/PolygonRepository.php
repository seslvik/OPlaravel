<?php


namespace App\Repositories;


use App\Models\Polygon as Model;

    /**
     * Create a class PolygonRepository.
     *
     *@package App/Repositories
     */
class PolygonRepository extends CoreRepository
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
        $pole = ['id','user_id','zavod','opisanie','updated_at']; //поля обязательны
        return $this->startConditions()->select($pole) //такой запрос уменьшает число обращений к базе
        ->where('zavod', $zavod)      //много запросов связано с тем, что я вывожу имя пользователя кто создал ОП в вьюшке
        ->orderBy('opisanie', 'asc')
            ->with(['user:id,name']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
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
        $pole = ['id','user_id','zavod', 'opisanie','updated_at', 'deleted_at'];
        return $this->startConditions()->onlyTrashed($pole) //такой запрос показывает только удаленные записи
        ->orderBy('deleted_at', 'desc')
            ->with(['user:id,name']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
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

}
