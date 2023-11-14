<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class seriecoleccion_M extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    protected $table = 'seriecoleccion';
    protected $primaryKey  = 'ID_Serie';
    protected $BorrarCampo = 'string';
    // public $timestamps = false; Cuando una tabla no tiene este campo se debe colocar "false"
}
