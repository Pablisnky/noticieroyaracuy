<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios_M extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $primaryKey  = 'ID_Comentario';
    // public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
}
