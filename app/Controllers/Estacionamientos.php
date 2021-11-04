<?php

namespace App\Controllers;

class Estacionamientos extends BaseController
{
    public function consultaEstacionamiento()
    {
        $datos = [];
        return view('inspectores/consultaEstacionamiento', $datos);
    }
}
