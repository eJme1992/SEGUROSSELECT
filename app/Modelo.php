<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    protected $fillable = [ 
        'id',
        'code_marca',
        'code',
        'name', 
	];
}
