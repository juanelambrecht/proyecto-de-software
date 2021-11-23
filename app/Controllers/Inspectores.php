<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Usuario;
use App\Models\Infraccion;

class Inspectores extends BaseController
{
    public function listarEstacionamiento()
    {
        $now = date('Y-m-d');
        $estadia = new Estadia();
        $datos['estadias'] = $estadia->where('fecha', $now)->findAll();
        // $time = time();

        // date("H:i:s", $time)
        // || ( $estadia->hora_inicio >= date("H:i:s", $time) && $estadia->hora_fin== NULL)
        // if( !empty($datos['estadiasDelDia'])){
        //     foreach($datos['estadiasDelDia'] as $estadia){
        //         if(date("H:i:s",$estadia->hora_inicio) >= date("H:i", $time) && date("H:i:s",$estadia->hora_fin) <= date("H:i:s", $time)){
        //             $datos['estadias'] = $estadia;
        //             print_r("entro al if");
        //         }    
        //         print_r(date("H:i",$estadia->hora_inicio));
        //         print_r("--");
        //         print_r(date("H:i", $time + 10800));
        //     }
        //     print_r($datos['estadias']);
        // }
        // No borrar por que puede servir.

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
