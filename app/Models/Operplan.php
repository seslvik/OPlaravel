<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operplan extends Model
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
