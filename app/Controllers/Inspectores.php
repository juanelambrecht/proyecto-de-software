<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Usuario;
use App\Models\Infraccion;

class Inspectores extends BaseController
{
    public function listarEstacionamiento()
    {
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $now = date('Y-m-d');
        $estadia = new Estadia();
        $datos['estadiasDelDia'] = $estadia->where('fecha', $now)->findAll();
        $time = time();
        
        
        //|| ( $estadia->hora_inicio >= date("H:i:s", $time) && $estadia->hora_fin== NULL)
        if( !empty($datos['estadiasDelDia'])){
            foreach($datos['estadiasDelDia'] as $estadia){
                $horaInicio = strtotime($estadia->hora_inicio); 
                $horaFin = strtotime($estadia->hora_fin);
                if( $horaInicio <= $time && $horaFin >= $time){
                    print_r($estadia);
                    die();
                     array_push($datos['estadias'], $estadia);
                }    
               
            }
            
        }
    

        $usuario = new Usuario();
        $datos['usuarios'] = $usuario->orderBy('id', 'ASC')->findAll();
        return view('inspectores/consultaEstacionamiento', $datos);
    }
    public function altaInfraccion(){


        return view('inspectores/altaInfraccion');
    }

    public function nuevaInfraccion(){
        $infraccion = new Infraccion();
        $datos = [
            'dia' => $this->request->getVar('fecha'),
            'hora' => $this->request->getVar('hora'),
            'calle' => $this->request->getVar('calle'),
            'calle_altura' => $this->request->getVar('altura'),
            'patente' => $this->request->getVar('patente')
        ];
        
        $infraccion->insert($datos);
        return $this->response->redirect(site_url('/consultaEstacionamiento'));
    }
}
