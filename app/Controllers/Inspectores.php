<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Usuario;

class Inspectores extends BaseController
{
    public function listarEstacionamiento()
    {
        $estadia = new Estadia();
        $datos['estadias'] = $estadia->orderBy('id', 'DESC')->findAll();
        $usuario = new Usuario();
        $datos['usuarios'] = $usuario->orderBy('id', 'ASC')->findAll();
        return view('inspectores/consultaEstacionamiento', $datos);
    }
}
