<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Usuario;

class Inspectores extends BaseController
{
    public function listarEstacionamiento()
    {
        $now = date('Y-m-d');
        $estadia = new Estadia();
        $datos['estadias'] = $estadia->where('fecha', $now)->findAll();
        $usuario = new Usuario();
        $datos['usuarios'] = $usuario->orderBy('id', 'ASC')->findAll();
        return view('inspectores/consultaEstacionamiento', $datos);
    }
}
