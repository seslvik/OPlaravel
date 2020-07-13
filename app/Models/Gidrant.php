<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gidrant extends Model
{
    use SoftDeletes;

    protected $fillable
        = [
            'objekt',
            'opisanie',
            'pos_x',
            'pos_y',
            'file',
        ];
}
