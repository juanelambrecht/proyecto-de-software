<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Cliente;
use App\Models\Vehiculo;
use App\Models\Tarjetas;
// use CodeIgniter\Controller;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Horario;
use App\Models\Zona;
//use Date;
// use DateInterval;
// use CodeIgniter\I18n\Time;
// use App\Controllers\strtotime;

class Usuarios extends BaseController
{
    var $saldoMinimoNegativoEnBilletera = -500;

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
    public function registrar()
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
        return $this->response->redirect(site_url('/login'));
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
    public function listadoZonaAdmin(){
        $zonas = new Zona();
        $datos['zonas'] = $zonas->orderBy('id','ASC')->FindAll();
       
        $horario = new Horario();
        $datos['horarios'] = $horario->orderBy('id','ASC')->FindAll();
        
        return view('usuarios/listadoZonaAdmin',$datos);
    }
    public function editarZona($id = null){

        $zona = new Zona();
        $datos['zonas'] = $zona->where('id', $id)-> first();
       
        return view('usuarios/editarZona',$datos);
    }
    public function actualizarZona(){
 
        $zonas = new Zona();
        $datos = $zonas->where('id', $this->request->getVar('id'))->first();
        
       
        $datos2= [
            'costo_horario' => $this->request->getVar('costo'),
        ];
        $zonas->update($this->request->getVar('id'),$datos2);

        $horaInicioAm = $this->request->getVar('horaInicioAm');
        $horaFinAm = $this->request->getVar('horaFinAm');
        $horaInicioPm = $this->request->getVar('horaInicioPm');
        $horaFinPm = $this->request->getVar('horaFinPm');
        
        $horario = new Horario();
        $horarioN = $horario->where('id', $datos['horarios_id'])->first();
        
        $datos1 = [
            'hora_inicio_am' => $horaInicioAm,
            'hora_fin_am' => $horaFinAm,
            'hora_inicio_pm' => $horaInicioPm,
            'hora_fin_pm' => $horaFinPm,
        ];
        $horario->update($horarioN['id'], $datos1);
        return $this->response->redirect(site_url('/listadoZonaAdmin'));
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
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        $clienteInfo = $cliente->where('usuario_id', $userSessionID)->first();
        $tarjeta = new Tarjetas();
        $info['tarjeta'] = $tarjeta->where('cliente_id', $clienteInfo['cliente_id'])->first();

        return view('usuarios/ingresarSaldo', $info);
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
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        $clienteInfo = $cliente->where('usuario_id', $userSessionID)->first();

        $tarjeta = new Tarjetas();
        $tarjetaCliente['tarjeta'] = $tarjeta->where('cliente_id', $clienteInfo['cliente_id'])->first();

        return view('usuarios/tarjetaCredito', $tarjetaCliente);
    }

    public function listarMisVentas()
    {
        $userSessionID = session()->get('id');
        $estadia = new Estadia();
        $datos['estadias'] = $estadia->where('user_id', $userSessionID)->findAll();
        $usuario = new Usuario();
        $datos['usuario'] = $usuario->where('id', $userSessionID)->first();
        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();
        return view('usuarios/ListarMisVentas', $datos);
    }

    public function misEstadiasPendientes()
    {
        $userSessionID = session()->get('id');
        // $cliente = new Cliente();
        // $datos['cliente'] = $cliente->where('usuario_id', $userSessionID)->first();
        // $clienteInfo = $datos['cliente'];
        // $vehiculo = new Vehiculo();
        // $datos['vehiculos'] = $vehiculo->where('cliente_id', $clienteInfo['cliente_id'])->orderBy('vehiculo_id', 'ASC')->findAll();
        // $vehiculosCliente = $datos['vehiculos'];
        $estadias = new Estadia();
        $array = array('user_id' => $userSessionID, 'pesosTotal <' => 0);
        $datos['estadias'] = $estadias->where($array)->orderBy('fecha', 'ASC')->findAll();
        // $estadiasSinPagar = $datos['estadias'];
        // print_r($estadiasSinPagar);
        // die();
        return view('usuarios/estadiasPendientes', $datos);
    }

    public function pagarEstadia($id = null)
    {
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        $clienteInfo = $cliente->where('usuario_id', $userSessionID)->first();
        $clienteID = $clienteInfo['cliente_id'];
        $estadia = new Estadia();
        $estadiaInfo = $estadia->where('id', $id)->first();
        $clienteNuevoSaldo = $clienteInfo['saldo'] + $estadiaInfo->pesosTotal;

        if ($clienteNuevoSaldo <= $this->saldoMinimoNegativoEnBilletera) {
            session()->setFlashData('mensaje', 'error');
            return redirect()->to('/misEstadiasPendientes');
        } else {
            $dataCliente = ['saldo' =>  $clienteNuevoSaldo];
            $dataEstadia = ['pesosTotal' => ($estadiaInfo->pesosTotal * -1)];

            $estadia->update($id, $dataEstadia);
            $cliente->update($clienteID, $dataCliente);

            return $this->response->redirect(site_url('./homeCliente'));
        }
    }

    public function creditCardEdit($id = null)
    {
        $userSessionID = session()->get('id');
        $cliente = new Cliente();
        $clienteInfo = $cliente->where('usuario_id', $userSessionID)->first();
        $clienteID = $clienteInfo['cliente_id'];
        $tarjeta = new Tarjetas();
        $tarjetaCliente['tarjeta'] = $tarjeta->where('cliente_id', $clienteID)->first();
        if ($tarjetaCliente['tarjeta'] == null) {
            // hago un insert
            $datosI = [
                'cliente_id' => $clienteID,
                'numero' => $this->request->getVar('num'),
                'fecha_ven' => $this->request->getVar('f_ven'),
                'cod_seguridad' => $this->request->getVar('cod_seg'),
            ];
            $tarjeta->insert($datosI);
        } else {
            // hago un update
            $datosU = [
                'numero' => $this->request->getVar('num'),
                'fecha_ven' => $this->request->getVar('f_ven'),
                'cod_seguridad' => $this->request->getVar('cod_seg'),
            ];

            $tarjeta->update($tarjetaCliente['tarjeta']['id'], $datosU);
        }

        return $this->response->redirect(site_url('/miWallet'));
    }
}
