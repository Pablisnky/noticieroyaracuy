<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obras_M extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'obra';
    protected $primaryKey  = 'ID_Obra';    
    // protected $fillable = ['fuente', 'titulo', 'subtitulo', 'contenido', 'portada', 'fecha', 'municipio'];
}
