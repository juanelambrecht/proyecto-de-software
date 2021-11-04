<?php

namespace App\Controllers;

class Inspectores extends BaseController
{
    public function listarEstacionamiento()
    {
        $datos = [];
        return view('inspectores/consultaEstacionamiento', $datos);
    }
}
