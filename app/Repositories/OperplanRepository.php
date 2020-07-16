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
     * @return Model
     */
    public function getIndex()
    {
        /*$colums = Operplan::where('zavod', 'Нафтан' )
            ->orderBy('objekt', 'asc')                      //это если нет связи по id с другой таблицей
            ->get();*/
        $pole = ['id','user_id','zavod','objekt', 'opisanie','file','updated_at']; //полч обязательны
        return $this->startConditions()->select($pole) //такой запрос уменьшает число обращений к базе
                    ->where('zavod', 'Нафтан')      //много запросов связано с тем, что я вывожу имя пользователя кто создал ОП в вьюшке
                    ->orderBy('objekt', 'asc')
                    ->with(['user:id,name']) //этот оператор ищет имена тех пользователей кто создал ОП и ищет в таблице user и выводит их name
                    //->toBase() //не создает модели
                    ->get(); //для этого необходимо в соответствующей модели создать метод user
    }
}
