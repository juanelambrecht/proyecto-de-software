<?php

namespace App\Models;

use CodeIgniter\Model;

class Estadia extends Model
{
    protected $table      = 'estadias';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'App\Entities\Estadia';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $allowedFields = [
        'user_id',
        'patente',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'pesosTotal',
        'zona_id'
    ];

    public function calcularPrecio($zonaId, $horaIni, $horaFin)
    {
        $hora_Inicio = strtotime($horaIni);
        $hora_Fin = strtotime($horaFin);
        // Calculo el tiempo en horas, redondeando para arriba
        $hrs = round((($hora_Fin - $hora_Inicio) / 60) / 60, 0);
        // Busco el precio de la zona 
        $zona = new Zona();
        $precioHoraZona = $zona->where('id', $zonaId)->first();
        // Calculo el precio a pagar
        $pesosTotal = ($precioHoraZona['costo_horario'] * $hrs);
        return $pesosTotal;

        // $datos = array(
        //     'precio' => $pesosTotal,
        // );
        // return $datos;
    }
}
