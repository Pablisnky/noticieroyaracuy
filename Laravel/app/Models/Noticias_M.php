<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias_M extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'noticias';
    protected $primaryKey  = 'ID_Noticia';    
    protected $fillable = ['fuente', 'titulo', 'subtitulo', 'contenido', 'portada', 'fecha', 'municipio'];
}