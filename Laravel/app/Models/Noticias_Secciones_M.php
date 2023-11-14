<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias_Secciones_M extends Model
{
    use HasFactory;

    protected $table = 'noticias_secciones';
    protected $primaryKey  = 'ID_N_S';
    // public $timestamps = false;
}
