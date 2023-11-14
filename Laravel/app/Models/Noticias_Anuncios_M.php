<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias_Anuncios_M extends Model
{
    use HasFactory;

    protected $table = 'noticias_anuncios';
    protected $primaryKey  = 'ID_N_A';
    // public $timestamps = false;
}
