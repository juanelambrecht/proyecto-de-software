<?php

namespace App\Models;

use CodeIgniter\Model;

class Estadia extends Model
{
    protected $table      = 'estadias';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'App\Entities\Estadia';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false;
    protected $allowedFields = [
        'user_id',
        'patente',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'pesosTotal',
        'zona_id '
    ];
}
