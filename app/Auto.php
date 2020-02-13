<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    
    protected $fillable = [ 
   'id',
   'code_marca',
   'code_modelo',
   'code_vehiculo',
   'id_vehiculo',
   'name',
   'cerokm',
];

}
