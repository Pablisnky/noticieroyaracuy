<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios_M extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $table = 'usuarios';
    protected $primaryKey = 'ID_Usuario';
}
