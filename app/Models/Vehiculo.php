<?php

namespace App\Models;

use CodeIgniter\Model;

class Vehiculo extends Model
{
    protected $table      = 'vehiculos';
    protected $primaryKey = 'vehiculo_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'App\Entities\VehiculoEnty';
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = [
        'patente',
        'marca',
        'modelo',
        'cliente_id'
    ];

    
}
