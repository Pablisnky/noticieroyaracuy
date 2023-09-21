<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuentes_M extends Model
{
    use HasFactory;

    protected $table = 'fuentes';
    protected $primaryKey  = 'ID_Fuente';
    // public $TimesTamp = false; //Cuando una tabla no tiene este campo se debe colocar "false"
}
