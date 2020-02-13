<?php

namespace App\Http\Controllers;

 define('apiSmartixURLBase',     "https://secure.smartix.com.ar/");
 define("apiSmartixUser",        "seguros@seguroselect.com"); // adminb2b2c@seguroselect.com
 define("apiSmartixPass",        "RAN001");
 define("apiSmartixIdCondicion", 133);

 define("apiSmartixURLSrvB2BTablas", apiSmartixURLBase."SmartixApi/ISrvB2BTablas.svc?wsdl");
 define("apiSmartixURLSrvB2BCotizacionVehiculon", apiSmartixURLBase."SmartixApiV2Beta/ISrvB2BCotizacionVehiculoV2.svc?wsdl");
 define("apiSmartixURLSrvB2BSolicitudPolizaVehiculo",apiSmartixURLBase."SmartixApi/ISrvB2BSolicitudPolizaVehiculo.svc?wsdl");
 


use Illuminate\Http\Request;
use SoapClient;
use stdClass;

class RequestController extends Controller {

        private $_client    =   null;
        private $_exceptions=   true;
        private $_trace     =   1;

        public function __construct()
        {
            $this->_getConn();
        }

        private function _getConn()
        {
            if( $this->_client == null )
            {

                $paramsConn     =   array(
                                    'trace'             	=> $this->_trace,
                                    'exceptions'        	=> $this->_exceptions,
                                    'connection_timeout'	=> 60,
                                    'stream_context' => stream_context_create(array(
										'ssl' => array(
											'verify_peer' => false,
											'verify_peer_name' => false,
											'allow_self_signed' => true
										)
									))
                );

				$client = new SoapClient('https://secure.smartix.com.ar/SmartixApiV2Beta/ISrvB2BCotizacionVehiculoV2.svc?wsdl', $paramsConn);
				$this->_client = $client;
            }

            return $this->_client;
        }

        private function _getUserParams()
        {
            $paramsUser     =   array(
                                    "SmartixUserName" => apiSmartixUser,
                                    "SmartixPassword" => apiSmartixPass,
                                    "IdCondicionB2B2C"=> apiSmartixIdCondicion
                                );

            return $paramsUser;
        }

        private function _logException(Exception $e)
        {
            $fp     =   fopen(dirname(dirname(__FILE__)).'/logs/'.date('d-m-Y').'.log','a');

            fwrite($fp, 'Archivo: '.$e->getFile() . ' Linea: '.$e->getLine(). ' Mensaje: ' .$e->getMessage() . ' Fecha: '.date('d-m-Y H:i:s').PHP_EOL);
            fwrite($fp, $e->getTraceAsString().PHP_EOL);
            fwrite($fp, str_repeat('----------',20).PHP_EOL);

            fclose($fp);
        }

        public function GetConfiguration()
        {
            try{
                $response = $this->_getConn()->GetConfiguracion(array('request' => $this->_getUserParams()));

                if( $response )
                {
                    $result     =   $response->GetConfiguracionResult;

                    if( $result->IsValid )
                    {
                        dd($result);
                    }
                    else
                    {

                        throw new Exception('Ocurrió un error al realizar la consulta.');
                    }
                }
            }
            catch(Exception $e)
            {
                $this->_logException($e);
            }
        }

        public function SaveForm($params)
        {
            $id         =   621;
            $postear    =   array(
                                '_wpcf7'        =>  $id,
                                '_wpcf7_version'=>  '3.1.1',
                                '_wpcf7_unit_tag'=> "wpcf7-f621-p622-o1",
                                '_wpnonce'      =>  wp_create_nonce("wpcf7-f621-p622-o1"),
                                'auto-anio'     =>  $params['AnioModelo'],
                                'auto-modelo'   =>  $_POST['auto'],
                                'idvehiculo'    =>  $params['IdVehiculoSmartix'],
                                'auto-uso'      =>  $params['CodigoTipoUso'],
                                'tipo-iva'      =>  $params['CodigoTipoIva'],
                                'gnc'           =>  $params['ValorGnc'],
                                'email'         =>  $params['InformacionLead']->Email,
                                'nombre'        =>  $params['InformacionLead']->Nombre,
                                'telefono'      =>  $params['InformacionLead']->Telefono1,
                                'codigo-postal' =>  $_POST['cp'],
                                'provincia'     =>  $params['CodigoProvincia'],
                                'ciudad'        =>  $params['CodigoCiudad'],
                                'fecha-nacimiento'=>$params['FechaNacimientoTitular']
                            );
            /*$_POST  =   $postear;

            $wpcf7_contact_form = wpcf7_contact_form( $id );
            $result = $wpcf7_contact_form->submit();*/
            global $wpdb;
            $unixtime   =   time();
            $wpdb->insert('wp_cf7dbplugin_st', array('submit_time' => $unixtime));

            $order  =   0;
            foreach( $postear as $key => $value ):
                $wpdb->insert('wp_cf7dbplugin_submits', array(
                                                            'submit_time' => $unixtime,
                                                            'form_name'   => 'Cotizacion',
                                                            'field_name'  => $key,
                                                            'field_value' => $value,
                                                            'field_order' => $order
                                                        ));

                $order++;
            endforeach;
        }

        public function IniciarCotizacion()
        {
            try{
           

                $params     =   $this->_getUserParams();

                $params['AnioModelo']              =   '2015';
                $params['CeroKm']                  =   'false';
                $params['CodigoProvincia']         =   '01';
                $params['CodigoTipoIva']           =   'CF';
                $params['CodigoTipoUso']           =   'PAR';
                $params['FechaNacimientoTitular']  =   '1985-09-15T00:00:00.000Z';
                $params['IdVehiculoSmartix']       =   '7576';
                $params['ValorGnc']                =   '0';
            
             
              

               
                $client = new SoapClient('https://secure.smartix.com.ar/SmartixApiV2Beta/ISrvB2BCotizacionVehiculoV2.svc?wsdl', (object)$params);
				

                //$response   =   $this->_getConn()->IniciarCotizacion(array('request' => (object)$params));
                dd($client);
                //file_put_contents(dirname(dirname(__FILE__)).'/logs/'."request-iniciarcotizacion.xml", $this->_getConn()->__getLastRequest() );
                //file_put_contents(dirname(dirname(__FILE__)).'/logs/'."response-iniciarcotizacion.xml", $this->_getConn()->__getLastResponse() );

                if( $response )
                {
                    $result     =   $response->IniciarCotizacionResult;

                    if( $result->IsValid )
                    {
                        return $result->IdCotizacion;
                    }
                    else
                    {

                        throw new Exception('Ocurrió un error al realizar la consulta.');
                    }
                }
            }
            catch(Exception $e)
            { //echo $e->getMessage();
                $this->_logException($e);
            }
        }

        public function GetResultado($id_cotizacion)
        {
            try{
                $params     = $this->_getUserParams();
                $params['IdCotizacion']             = $id_cotizacion;
                $params['TipoCotizacionRespuesta']  =   "Indistinto";

                $response = $this->_getConn()->GetResultado(array('request' => $params));

                if( $response )
                {
                    $result     =   $response->GetResultadoResult;

                    if( $result->IsValid )
                    {
                        return $result;
                    }
                    else
                    {

                        throw new Exception('Ocurrió un error al realizar la consulta.');
                    }
                }
            }
            catch(Exception $e)
            {
                $this->_logException($e);
            }
        }

        public function GetResultadoNormalizado($id_cotizacion)
        {
            try{
                $params     = $this->_getUserParams();
                $params['IdCotizacion']             = $id_cotizacion;
                $params['TipoCotizacionRespuesta']  = "Indistinto";
                    //echo '<pre>';var_dump(array('request' => (object)$params));die();
                $response = $this->_getConn()->GetResultadoNormalizado(array('request' => (object)$params));

                if( $response )
                {
                    $result     =   $response->GetResultadoNormalizadoResult;

                    if( $result->IsValid )
                    {
                        return $result;
                    }
                    else
                    {

                        throw new Exception('Ocurrió un error al realizar la consulta.');
                    }
                }
            }
            catch(Exception $e)
            {
                $this->_logException($e);
            }
        }

        public function GetCotizacion($id_cotizacion)
        {
            try{
                $params     = $this->_getUserParams();
                $params['IdCotizacion']             = $id_cotizacion;
                $params['TipoCotizacionRespuesta']  = "Indistinto";
                     //echo '<pre>';var_dump(array('request' => (object)$params));die();
                $response = $this->GetResultadoNormalizado($id_cotizacion);
                file_put_contents(dirname(dirname(__FILE__)).'/logs/'."request-getresultado.xml", $this->_getConn()->__getLastRequest() );
                file_put_contents(dirname(dirname(__FILE__)).'/logs/'."response-getresultado.xml", $this->_getConn()->__getLastResponse() );
                     //echo '<pre>';var_dump($response);die();
                if( $response )
                {
                    $result     =   $response;//->Productos->ItemCotizadoDTO;

                    return $result;
                }
            }
            catch(Exception $e)
            {
                $this->_logException($e);
            }
        }
}
