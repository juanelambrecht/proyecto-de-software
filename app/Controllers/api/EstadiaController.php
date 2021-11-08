<?php

namespace App\Controllers\api;

use App\Models\Estadia;
use CodeIgniter\RESTful\ResourceController;

class EstadiaController extends ResourceController
{
    protected $modelName = 'App\Models\Estadia';
    protected $format    = 'json';

    public function precio($zonaId, $horaIni, $horaFin)
    {

        $datos = $this->model->calcularPrecio($zonaId, $horaIni, $horaFin);
        return $this->respond($datos);
    }
}
