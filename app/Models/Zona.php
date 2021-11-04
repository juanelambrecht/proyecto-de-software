<?php

namespace App\Models;

use CodeIgniter\Model;

class Zona extends Model
{

    protected $table      = 'zonas';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $allowedFields = ['descripcion', 'ubicacion_id', 'horarios_id', 'costo_horario'];
}
