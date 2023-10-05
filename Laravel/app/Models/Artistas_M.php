<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artistas_M extends Model
{
    use HasFactory;

    public $TimesTamp = false;
    protected $table = 'artistas';
    protected $primaryKey  = 'ID_Artista'; 
}
