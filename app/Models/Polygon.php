<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Polygon extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'opisanie',
            'color',
            'pos_x_1',
            'pos_y_1',
            'pos_x_2',
            'pos_y_2',
            'pos_x_3',
            'pos_y_3',
            'pos_x_4',
            'pos_y_4',
            'pos_x_5',
            'pos_y_5',
            'pos_x_6',
            'pos_y_6',
            'pos_x_7',
            'pos_y_7',
            'pos_x_8',
            'pos_y_8',

        ];
}
