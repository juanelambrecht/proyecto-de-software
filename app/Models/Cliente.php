<?php

namespace App\Models;

use CodeIgniter\Model;

class Cliente extends Model
{
    protected $table      = 'cliente';
    protected $primaryKey = 'cliente_id';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = [
        'usuario_id',
        'saldo'
    ];


    
}
