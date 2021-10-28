<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Usuario;
use App\Models\Rol;

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
        return view('usuarios/homeInspector', $datos);
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
        // Aca miren la ruta que deberia ir despues del editar
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
        // print_r("entro a autenticate");
        //Redireccionar segun resultado de validación.
        if ($result) {
            $sessData = array(
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

        // $data = array(
        //     'yourfieldname' => value,
        //     'name' => $name,
        //     'date' => $date
        // );

        // $this->db->where('yourfieldname', yourfieldvalue);
        // $this->db->update('yourtablename', $data);
    }
}
