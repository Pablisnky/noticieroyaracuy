<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes_M extends Model
{
    use HasFactory;
    
    public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
    protected $table = 'imagenes';
    protected $primaryKey  = 'ID_Imagen';
}
