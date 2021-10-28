<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuario extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'App\Entities\User';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = ['nombre', 'apellido', 'username', 'contraseña', 'email', 'dni', 'fecha_nacimiento', 'id_rol'];

    public function validUser($data)
    {
        $this->where('username', $data['username']);
        $this->where('contraseña', $data['pass']);

        $query = $this->get(1);
        // edit on web
        if ($query->getResult())
            return $query->getResult();
        else
            return false;
    }
}
