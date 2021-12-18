<?php 
namespace App\Models;

use CodeIgniter\Model;

class LibroModel extends Model{
    protected $table      = 'libros';
    protected $primaryKey = 'idLibro';
    protected $allowedFields = ['aNombreLibro', 'mImagen'];
}