<?php

namespace App\Filters;

use CodeIgniter\CLI\Console;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleValidationFilter implements FilterInterface
{

    public $publicas = array(
        'login',
        'autenticate',
        'usuarios/login',
        'usuarios/autenticate',
        'error/403',
        'welcome_message',
        '/errors/error_403',
        'registrar',
        'home-template',
    );
    // 1 => Admin // 2=> Inspector, // 3=> Vendedor, // 4=> Cliente
    public $rol_permisos = array(
        // 1 => Admin
        '1' => array(
            'api',
            'precio',
            'usuarios',
            'actualizar',
            'guardar',
            'listar',
            'venderEstadiaAdmin',
            'venderNuevaEstadiaAdmin',
            'editar',
            'crear',
            'borrar',
            'resetPass',
            'consultaEstacionamientoAdmin',
            'editarPerfil',
            'intern-template',
            'actualizarPerfil',
            'listadoZonaAdmin',
            'editarZona',
            'actualizarZona'
        ),
        // 2=> Inspector
        '2' => array(
            'homeInspector',
            'editarPerfil',
            'actualizarPerfil',
            'usuarios',
            'inspectores',
            'consultaEstacionamiento',
            'intern-template',
            'altaInfraccion',
            'nuevaInfraccion'
        ),
        // 3=> Vendedor
        '3' => array(
            'api',
            'precio',
            'editarPerfil',
            'actualizarPerfil',
            'homeVendedor',
            'usuarios',
            'vendedor',
            'venderEstadia',
            'venderNuevaEstadia',
            'intern-template',
            'listarMisVentas'
        ),
        // 4=> Cliente
        '4' => array(
            'usuarios',
            'homeCliente',
            'usuarios',
            'altaVehiculo',
            'altaNuevoVehiculo',
            'desestacionarV',
            'desestacionarVehiculo',
            'estacionarGuardaVehiculo',
            'estacionarVehiculo',
            'comprarNuevaEstadia',
            'estacionarIndefinido',
            'venderEstadiaIndefinido',
            'estacionarNuevoPendiente',
            'estacionarPendiente',
            'actualizarPerfil',
            'editarPerfil',
            'intern-template',
            'api',
            'precio',
            'ingresarSaldo',
            'cargarSaldo',
            'miWallet',
            'tarjetaCredito',
            'misEstadiasPendientes',
            'pagarEstadia',
            'creditCardEdit'
        ),
    );
    public $rol_no_puede = array(
        '1' => array(),
        '2' => array(),
        '3' => array(),
        '4' => array(),
    );


    public function before(RequestInterface $request, $arguments = null)
    {
        $auth = session()->isLoggedIn;

        $uri_segments = explode('/', uri_string());

        $is_public = in_array(uri_string(), $this->publicas);

        if (!$auth && !$is_public) {
            return redirect()->to('/usuarios/login');
        }

        $role = session()->role;

        if ($auth && !$is_public && !$this->validoURI($uri_segments, $role)) {
            return redirect()->to('/error/403');
        }
    }

    public function validoURI($segmentos, $role)
    {
        return in_array($segmentos[0], $this->rol_permisos[$role]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
