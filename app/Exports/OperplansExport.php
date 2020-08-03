<?php

namespace App\Exports;

use App\Models\Operplan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OperplansExport implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Database\Eloquent\Collection
    */
    public function collection()
    {
        $pole =['zavod','objekt', 'opisanie','file','created_at','updated_at'];
        return Operplan::select($pole)->get();
    }

    public function headings(): array
    {
        return [
            'Завод',
            'Объект',
            'Описание',
            'Имя файла',
            'Создан',
            'Обновлён',
        ];
    }

    public function title(): string
    {
        return 'Оперпланы';
    }
}
