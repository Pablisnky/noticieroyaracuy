<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador_M extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'administrador';
    protected $primaryKey  = 'ID_Administrador';
}
