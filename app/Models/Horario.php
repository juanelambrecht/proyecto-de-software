<?php

namespace App\Models;

use CodeIgniter\Model;

class Horario extends Model
{
    protected $table      = 'horarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

   protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = [
        'dia_inicio',
        'dia_fin',
        'hora_inicio_am',
        'hora_fin_am',
        'hora_inicio_pm',
        'hora_fin_pm'
    ];


    
}