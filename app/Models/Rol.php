<?php 
namespace App\Models;

use CodeIgniter\Model;

class Rol extends Model{
    protected $table      = 'roles';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields= ['nombre','descripcion'];
}