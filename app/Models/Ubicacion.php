<?php

namespace App\Models;

use CodeIgniter\Model;

class Ubicacion extends Model
{
    protected $table      = 'ubicacion';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'calle_1',
        'calle_1_1',
        'calle_2',
        'calle_2_2',

    ];
}