<?php

namespace App\Models;

use CodeIgniter\Model;

class Infraccion extends Model
{
    protected $table      = 'infracciones';
    protected $primaryKey = 'infraccion_id';

    protected $useAutoIncrement = true;

   protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = [
        'dia',
        'hora',
        'calle',
        'calle_altura',
        'patente'
    ];


    
}