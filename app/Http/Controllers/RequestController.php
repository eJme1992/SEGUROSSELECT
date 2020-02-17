<?php

namespace App\Http\Controllers;

use App\Smartix;
use Illuminate\Http\Request;

class RequestController extends Controller { 


    public function Conexion()
    {
      $Smartix = new Smartix();  
      return $Smartix->GetConfiguration();
    }

    public function Cotizar(Request $request)
    { 
         
        
          $AnioModelo        =  $request->input('estado');
          $CodigoProvincia   =  $request->input('provincia'); 
          $DateTime          =  $request->input('nacimiento');
          $IdVehiculoSmartix =  $request->input('auto'); 
          $ValorGnc          =  $request->input('valor-gns');
          $CodigoPostal      =  $request->input('postal');
          
          //$CeroKm            =  $request->input('nombrec');
          //$CodigoEstadoCivil =  $request->input('nombrec');
          //$CodigoTipoIva     =  $request->input('nombrec');
          //$CodigoTipoUso     =  $request->input('nombrec');
         

          
  

    
      $Smartix = new Smartix();  
      $respuesta = $Smartix->IniciarCotizacion($AnioModelo, $CeroKm, $CodigoProvincia,$CodigoTipoIva,$CodigoTipoUso,$DateTime,$IdVehiculoSmartix,$ValorGnc,$CodigoEstadoCivil,$CodigoPostal);
    }


   


}

