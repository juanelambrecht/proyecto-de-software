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
        $datos1['estadias']=[];
        $time = time();
        

        if( !empty($datos['estadiasDelDia'])){
            foreach($datos['estadiasDelDia'] as $estadiaN){
                $horaInicio = strtotime($estadiaN->hora_inicio); 
                $horaFin = strtotime($estadiaN->hora_fin);
                if( ($horaInicio <= $time && $horaFin >= $time) || ( $horaInicio <= $time && $estadiaN->hora_fin== NULL)){
                    
                     array_push($datos1['estadias'], $estadiaN);
                }    
               
            }
            
        }
        else
        {
            $datos['estadias'] = $estadia->where('fecha', $now)->findAll();
        }
    
        $datos['estadias']= $datos1['estadias'];
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
