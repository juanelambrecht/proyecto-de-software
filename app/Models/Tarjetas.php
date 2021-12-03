<?php

namespace App\Models;

use CodeIgniter\Model;

class Tarjetas extends Model
{
    protected $table      = 'tarjetas';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = [
        'cliente_id',
        'numero',
        'fecha_ven',
        'cod_seguridad',
    ];
}
