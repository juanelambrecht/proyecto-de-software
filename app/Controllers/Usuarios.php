<?php

namespace App\Controllers;

use App\Models\Estadia;
use App\Models\Vehiculo;
use CodeIgniter\Controller;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Zona;
use DateTime;
use DateInterval;
use CodeIgniter\I18n\Time;
use App\Controllers\strtotime;

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

        $datos = [];
        return view('usuarios/homeCliente', $datos);
    }
    public function homeInspector()
    {

        $datos = [];
        return view('inspectores/consultaEstacionamiento', $datos);
    }
    public function homeVendedor()
    {

        $datos = [];
        return view('usuarios/homeVendedor', $datos);
    }

    public function crear()
    {
        $rol = new Rol();
        $datos['roles'] = $rol->orderBy('id', 'ASC')->findAll();

        return view('usuarios/crear', $datos);
    }
    public function listarEstacionamiento()
    {
        $datos = [];
        return view('usuarios/consultaEstacionamiento', $datos);
    }
    public function venderEstadia()
    {
        $zona = new Zona();
        $datos['zonas'] = $zona->orderBy('id', 'ASC')->findAll();
        return view('usuarios/venderEstadia', $datos);
    }

    public function venderNuevaEstadia()
    {
        $db = \Config\Database::connect();
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
            // 'pesosTotal' => 0,
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
        //$estadia->insert($newData);
        $db->table('estadias')->insert($newData);
        return $this->response->redirect(site_url('/venderEstadiaAdmin'));
    }


    public function guardar()
    {

        $usuario = new Usuario();
        $datos = [
            'nombre' => $this->request->getVar('nombre'),
            'email' => $this->request->getVar('email'),
            'apellido' => $this->request->getVar('apellido'),
            'username' => $this->request->getVar('usuario'),
            'dni' => $this->request->getVar('dni'),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'contraseña' => $this->request->getVar('contraseña'),
            'id_rol' => $this->request->getVar('rol')
        ];

        $usuario->insert($datos);

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
                return redirect()->to('/homeInspector');
            }
            if ($result[0]->id_rol == 3) {
                return redirect()->to('/homeVendedor');
            }
            if ($result[0]->id_rol == 4) {
                return redirect()->to('/homeCliente');
            }
        } else {
            session()->set(array('error' => 'Error Usuario o Contraseña Invalidos'));
            session()->markAsFlashdata('error');
            return redirect()->to('/login');
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
        $db = \Config\Database::connect();
        $vehiculo = new Vehiculo();
        $datos = [
            'patente' => $this->request->getVar('patente'),
            'marca' => $this->request->getVar('marca'),
            'modelo' => $this->request->getVar('modelo'),
            'cliente_id' =>  $userSessionID = session()->get('id')
        ];
        //$vehiculo->insert($datos);
       $db->table('vehiculos')->insert($datos);
       return $this->response->redirect(site_url('/homeCliente'));
    }
}