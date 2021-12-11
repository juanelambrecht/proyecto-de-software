<?php

namespace App\Controllers;

use App\Models\Estadia;
use CodeIgniter\Controller;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Zona;
use DateTime;
use DateInterval;
use CodeIgniter\I18n\Time;
use App\Controllers\strtotime;



class Vendedor extends BaseController
{

    public function venderEstadia()
    {
        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();
        return view('vendedor/venderEstadia', $datos);
    }

    public function venderNuevaEstadia()
    {
        $userSessionID = session()->get('id');
        $estadia = new Estadia();
        $now = date('Y-m-d');
        $datos2= array('fecha' => $now, 'patente' => $this->request->getVar('patente'));
        $datos['estadiasDelDia'] = $estadia->where($datos2)->findAll();
       
        if( !empty($datos['estadiasDelDia'])){
            foreach($datos['estadiasDelDia'] as $estadiaN){
                $horaInicio = strtotime($estadiaN->hora_inicio); 
                $horaFin = strtotime($estadiaN->hora_fin);
                $horaInicioA= strtotime($this->request->getVar('hora_inicio'));
                $horaFinA= strtotime($this->request->getVar('hora_fin'));
                if( ($horaInicioA < $horaInicio && $horaFinA <= $horaInicio) || ( $horaFin <= $horaInicioA  && $horaFin <= $horaFinA)){
                    $datos = [
                        'user_id' => $userSessionID,
                        'patente' => $this->request->getVar('patente'),
                        'fecha' => $now,
                        'hora_inicio' => $this->request->getVar('hora_inicio'),
                        'hora_fin' => $this->request->getVar('hora_fin'),
                        'pesosTotal' => 0,
                        'zona_id' => $this->request->getVar('zona')
                    ];
                    $horaInicio = strtotime($datos['hora_inicio']);
                    $horaFin = strtotime($datos['hora_fin']);
                    // Calculo el tiempo en horas, redondeando para arriba
                    $hrs = round((($horaFin - $horaInicio) / 60) / 60, 0);
                    // Busco el precio de la zona 
                    $zona = new Zona();
                    $zonaArray = $zona->where('id', $datos['zona_id'])->first();
                    // Calculo el precio a pagar
                    $pesosTotal = ($zonaArray['costo_horario'] * $hrs);
                    // Inserto el nuevo precio 
                    $newData = array_merge($datos, array("pesosTotal" => $pesosTotal));
                    $estadia->insert($newData);
                
                } else{
                    session()->setFlashData('estacionarFail','error');
                } 
 
               
            }
            
        }
    
        return $this->response->redirect(site_url('/venderEstadia'));
    }

    public function consultarPrecio()
    {
        $datos = [
            'hora_inicio' => $this->request->getVar('hora_inicio'),
            'hora_fin' => $this->request->getVar('hora_fin'),
            'zona_id' => $this->request->getVar('zona')
        ];
        $horaInicio = strtotime($datos['hora_inicio']);
        $horaFin = strtotime($datos['hora_fin']);
        // Calculo el tiempo en horas, redondeando para arriba
        $hrs = round((($horaFin - $horaInicio) / 60) / 60, 0);
        // Busco el precio de la zona 
        $zona = new Zona();
        $precioHoraZona = $zona->where('id', $datos['zona_id'])->first();
        // Calculo el precio a pagar
        $pesosTotal = ($precioHoraZona['costo_horario'] * $hrs);
        return $pesosTotal;
    }
}
