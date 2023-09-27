<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodigoRecuperacion_M extends Model
{
    use HasFactory;

    public $TimesTamp = false;
    protected $table = 'codigorecuperacion';
    protected $primaryKey  = 'ID_Codigorecuperacion ';
}
