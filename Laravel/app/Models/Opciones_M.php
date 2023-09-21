<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones_M extends Model
{
    use HasFactory;
    
    public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
    protected $table = 'opciones';
    protected $primaryKey = 'ID_Opcion';
}