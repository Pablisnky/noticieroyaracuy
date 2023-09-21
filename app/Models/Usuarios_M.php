<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_M extends Model
{
    use HasFactory;
    
    public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
    protected $table = 'usuarios';
    protected $primaryKey = 'ID_Usuario';
}
