<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesionalImagenes_M extends Model
{
    use HasFactory;
    
    protected $table = 'imagenesdirectorio';
    protected $primaryKey  = 'ID_imagenesprofesional ';
    public $TimesTamp = false;
}
