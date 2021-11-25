<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Cliente;
use App\Models\Vehiculo;
// use CodeIgniter\Controller;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Zona;
//use Date;
// use DateInterval;
// use CodeIgniter\I18n\Time;
// use App\Controllers\strtotime;

class Usuarios extends BaseController
{

    public function index()
    {
        $usuario = new Usuario();
        $datos['usuarios'] = $usuario->orderBy('id', 'ASC')->findAll();

        $rol = new Rol();
        $datos['roles'] = $rol->orderBy('id', 'ASC')->findAll();

        return view('usuarios/listar', $datos);
    }

    public function homeCliente()
    {
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        $datos['cliente'] = $cliente->where('usuario_id', $userSessionID)->first();
        $vehiculo = new Vehiculo();
        $datos['vehiculos'] = $vehiculo->orderBy('vehiculo_id', 'ASC')->findAll();

        return view('usuarios/homeCliente', $datos);
    }

    public function homeVendedor()
    {

        $datos = [];
        return view('usuarios/homeVendedor', $datos);
    }
    public function listarEstacionamiento()
    {
        $now = date('Y-m-d');
        $estadia = new Estadia();
        $datos['estadias'] = $estadia->where('fecha', $now)->findAll();
        $usuario = new Usuario();
        $datos['usuarios'] = $usuario->orderBy('id', 'ASC')->findAll();
        return view('usuarios/consultaEstacionamientoAdmin', $datos);
    }

    public function crear()
    {
        $rol = new Rol();
        $datos['roles'] = $rol->orderBy('id', 'ASC')->findAll();

        return view('usuarios/crear', $datos);
    }


    public function estacionarVehiculo()
    {
        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();
        return view('usuarios/estacionarVehiculo', $datos);
    }
    public function estacionarIndefinido($id)
    {
        $vehiculo = new Vehiculo();
        $datos['vehiculo'] = $vehiculo->where('vehiculo_id', $id)->first();

        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();
        return view('usuarios/estacionarIndefinido', $datos);
    }
    public function estacionarPendiente($id)
    {
        $vehiculo = new Vehiculo();
        $datos['vehiculo'] = $vehiculo->where('vehiculo_id', $id)->first();

        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();

        return view('usuarios/estacionarPendiente', $datos);
    }
    public function estacionarNuevoPendiente()
    {
        // Get user session ID
        $userSessionID = session()->get('id');
        // Creo la estadia
        $estadia = new Estadia();
        $now = date('Y-m-d');
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
        $precioHoraZona = $zona->where('id', $datos['zona_id'])->first();
        // Calculo el precio a pagar
        $pesosTotal = ($precioHoraZona['costo_horario'] * $hrs);
        $pesosTotal = 0 - $pesosTotal;
        // Inserto el nuevo precio 
        $newData = array_merge($datos, array("pesosTotal" => $pesosTotal));
        $estadia->insert($newData);
        return $this->response->redirect(site_url('/homeCliente'));
    }

    public function venderEstadiaAdmin()
    {
        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();
        return view('usuarios/venderEstadia', $datos);
    }

    public function venderNuevaEstadiaAdmin()
    {
        // Get user session ID
        $userSessionID = session()->get('id');
        // Creo la estadia
        $estadia = new Estadia();
        $now = date('Y-m-d');
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
        $precioHoraZona = $zona->where('id', $datos['zona_id'])->first();
        // Calculo el precio a pagar
        $pesosTotal = ($precioHoraZona['costo_horario'] * $hrs);
        // Inserto el nuevo precio 
        $newData = array_merge($datos, array("pesosTotal" => $pesosTotal));
        $estadia->insert($newData);
        return $this->response->redirect(site_url('/venderEstadiaAdmin'));
    }
    public function venderEstadiaIndefinido()
    {
        // Get user session ID
        $userSessionID = session()->get('id');
        // Creo la estadia
        $estadia = new Estadia();
        $now = date('Y-m-d');
        $datos = [
            'user_id' => $userSessionID,
            'patente' => $this->request->getVar('patente'),
            'fecha' => $now,
            'hora_inicio' => $this->request->getVar('hora_inicio'),
            'hora_fin' => NULL,
            'pesosTotal' => 0,
            'zona_id' => $this->request->getVar('zona')
        ];
        $estadia->insert($datos);
        return $this->response->redirect(site_url('/homeCliente'));
    }
    public function estacionarGuardaVehiculo()
    {
        // Get user session ID
        $userSessionID = session()->get('id');
        // Creo la estadia
        $estadia = new Estadia();
        $now = date('Y-m-d');
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
        $precioHoraZona = $zona->where('id', $datos['zona_id'])->first();
        // Calculo el precio a pagar
        $pesosTotal = ($precioHoraZona['costo_horario'] * $hrs);
        // Inserto el nuevo precio 
        $newData = array_merge($datos, array("pesosTotal" => $pesosTotal));
        $estadia->insert($newData);
        return $this->response->redirect(site_url('/estacionarVehiculo'));
    }

    public function guardar()
    {

        $usuario = new Usuario();
        $cliente = new Cliente();
        $datosU = [
            'nombre' => $this->request->getVar('nombre'),
            'email' => $this->request->getVar('email'),
            'apellido' => $this->request->getVar('apellido'),
            'username' => $this->request->getVar('usuario'),
            'dni' => $this->request->getVar('dni'),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'contraseña' => $this->request->getVar('contraseña'),
            'id_rol' => $this->request->getVar('rol')
        ];
        $usuario->insert($datosU);

        if ($this->request->getVar('rol') == 4) {
            $idUsuario = $usuario->where('username', $this->request->getVar('usuario'))->first();
            $datosC = [
                'usuario_id' => $idUsuario->id,
                'saldo' => 200
            ];
            $cliente->insert($datosC);
        }
        return $this->response->redirect(site_url('/listar'));
    }

    public function borrar($id = null)
    {
        $usuario = new Usuario();
        $usuario->where('id', $id);
        $usuario->delete($id);
        return $this->response->redirect(site_url('/listar'));
    }

    public function editar($id = null)
    {
        $usuario = new Usuario();
        $rol = new Rol();
        $datos['roles'] = $rol->orderBy('id', 'ASC')->findAll();
        $datos['usuario'] = $usuario->where('id', $id)->first();
        return view('usuarios/editar', $datos);
    }

    public function editarPerfil($id = null)
    {
        $usuario = new Usuario();
        $datos['usuario'] = $usuario->where('id', $id)->first();
        $rol = new Rol();
        $datos['roles'] = $rol->orderBy('id', 'ASC')->findAll();
        // $path = APPPATH .'views/template/'; // {$this->theme}
        //$view = \Config\Services::renderer($path, null, false); 
        //return $view->setVar('data', $datos)->render('usuarios/editarPerfil'); 
        return view('usuarios/editarPerfil', $datos);
    }

    public function actualizar()
    {
        $usuario = new Usuario();
        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'email' => $this->request->getVar('email'),
            'apellido' => $this->request->getVar('apellido'),
            'username' => $this->request->getVar('usuario'),
            // 'contraseña' => $this->request->getVar('contraseña'),
            'dni' => $this->request->getVar('dni'),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'id_rol' => $this->request->getVar('rol')
        ];
        $id = $this->request->getVar('id');
        $usuario->update($id, $datos);
        return $this->response->redirect(site_url('../listar'));
    }

    public function actualizarPerfil()
    {
        $usuario = new Usuario();
        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'email' => $this->request->getVar('email'),
            'apellido' => $this->request->getVar('apellido'),
            'username' => $this->request->getVar('usuario'),
            // 'contraseña' => $this->request->getVar('contraseña'),
            'dni' => $this->request->getVar('dni'),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
        ];
        $id = $this->request->getVar('id');
        $usuario->update($id, $datos);
        print_r($id);
        if ($id == 1) {
            return $this->response->redirect(site_url('./listar'));
        }
        if ($id == 2) {
            return $this->response->redirect(site_url('/consultaEstacionamiento'));
        }
        if ($id == 3) {
            return $this->response->redirect(site_url('/homeVendedor'));
        }
        if ($id == 4) {
            return $this->response->redirect(site_url('./homeCliente'));
        }
    }

    public function login()
    {
        $datos = [];
        return view('usuarios/login', $datos);
    }

    public function autenticate()
    {
        // tomar los datos de login
        $data = $this->request->getPost();
        $usuario = new Usuario();
        //Validar con la BD ususario y pass.
        $result = $usuario->validUser($data);
        //Redireccionar segun resultado de validación.
        if ($result) {
            $sessData = array(
                'id' => $result[0]->id,
                'username' => $result[0]->username,
                'role' => $result[0]->id_rol,
                'isLoggedIn' => true
            );
            session()->set($sessData);
            if ($result[0]->id_rol == 1) {
                return redirect()->to('/listar');
            }
            if ($result[0]->id_rol == 2) {
                return redirect()->to('/consultaEstacionamiento');
            }
            if ($result[0]->id_rol == 3) {
                return redirect()->to('/homeVendedor');
            }
            if ($result[0]->id_rol == 4) {
                return redirect()->to('/homeCliente');
            }
        } else {
            //session()->set(array('error' => 'Error Usuario o Contraseña Invalidos'));
            //session()->markAsFlashdata('error');
            session()->setFlashData('mensaje', 'error');
            return redirect()->to('/login#about');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function resetPass($id = null)
    {
        $usuario = new Usuario();
        $data = ['contraseña' => '123456'];
        $usuario->update($id, $data);
        return $this->response->redirect(site_url('/listar'));
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

    public function altaVehiculo($id = null)
    {

        return view('usuarios/altaVehiculo');
    }

    public function altaNuevoVehiculo()
    {
        //$db = \Config\Database::connect();
        $vehiculo = new Vehiculo();
        $cliente = new Cliente();
        $usuario_session = $userSessionID = session()->get('id');
        $cliente_id = $cliente->where('usuario_id', $usuario_session)->first();
        $datos = [
            'patente' => $this->request->getVar('patente'),
            'marca' => $this->request->getVar('marca'),
            'modelo' => $this->request->getVar('modelo'),
            'cliente_id' =>  $cliente_id['cliente_id']
        ];

        $vehiculo->insert($datos);
        //$db->table('vehiculos')->insert($datos);
        return $this->response->redirect(site_url('/homeCliente'));
    }

    public function desestacionarV()
    {
        $userSessionID = session()->get('id');
        $estadia = new Estadia();
        $array = array('user_id' => $userSessionID, 'hora_fin' => null);
        $datos['estadias'] = $estadia->where($array)->findAll();
        return view('usuarios/desestacionar', $datos);
    }

    public function desestacionarVehiculo($id = null)
    {
        // hora actual en la cual se desestaciona => hora_fin de la estadia
        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $nowtime = date("H:i:s");
        $estadia = new Estadia();
        $datos = $estadia->where('id', $id)->first();
        // hora inicio de la estadia
        $horaInicio = $datos->hora_inicio;
        // Calculo el tiempo en horas, redondeando para arriba
        $hrs = round(((strtotime($nowtime) - strtotime($horaInicio)) / 60) / 60, 0);
        // Busco el precio de la zona 
        $zona = new Zona();
        $precioHoraZona = $zona->where('id', $datos->zona_id)->first();
        // Calculo el precio a pagar
        $pesosTotal = (($precioHoraZona['costo_horario'] * $hrs) * -1);
        $datos1 = [
            'hora_fin' => $nowtime,
            'pesosTotal' => $pesosTotal,
        ];
        $estadia->update($id, $datos1);
        return $this->response->redirect(site_url('/homeCliente'));
    }

    public function ingresarSaldo()
    {

        return view('usuarios/ingresarSaldo');
    }

    public function cargarSaldo($id = null)
    {
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        //busco cliente
        $datos = $cliente->where('usuario_id', $userSessionID)->first();
        $clienteID = $datos['cliente_id'];
        //calculo nuevo saldo
        $saldoIngresado = $this->request->getVar('monto');
        $saldoTotal = ($saldoIngresado + $datos['saldo']);
        $data = ['saldo' => $saldoTotal];
        //updateo cliente con nuevo saldo
        $cliente->update($clienteID, $data);
        return $this->response->redirect(site_url('/homeCliente'));
    }

    public function miWallet()
    {
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        $datos['cliente'] = $cliente->where('usuario_id', $userSessionID)->first();
        return view('usuarios/infoWallet', $datos);
    }

    public function tarjetaCredito()
    {

        return view('usuarios/tarjetaCredito');
    }
}
