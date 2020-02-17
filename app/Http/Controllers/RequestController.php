<?php

namespace App\Http\Controllers;

use App\Smartix;
use Illuminate\Http\Request;

class RequestController extends Controller { 


    public function Conexion()
    {
      $Smartix = new Smartix();



     
      $Smartix->GetConfiguration();
    }
}

