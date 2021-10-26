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
        '/errors/error_403'
    );
    // 1 => Admin, 2=>Inspector, 3=>Vendedor, 4=>Cliente
    public $rol_permisos = array(
        '1' => array('usuarios', 'actualizar', 'guardar', 'listar', 'editar', 'crear', 'borrar', 'resetPass'),
        '2' => array('homeInspector', 'usuarios'),
        '3' => array('homeVendedor', 'usuarios'),
        '4' => array('homeCliente', 'usuarios'),
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
