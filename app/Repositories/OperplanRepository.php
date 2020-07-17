<?php


namespace App\Repositories;

use App\Models\Operplan as Model;

/**
 * Create a class OperplanRepository.
 *
 *@package App/Repositories
 */
class OperplanRepository extends CoreRepository
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
