<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComerciantePasword_M extends Model
{
    use HasFactory;

    protected $table = 'comerciantepasword';
    protected $primaryKey  = 'ID_Comerciantepasword'; 
    // public $timestamps = false;
}
