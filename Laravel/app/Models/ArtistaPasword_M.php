<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistaPasword_M extends Model
{
    use HasFactory;

    public $TimesTamp = false;
    protected $table = 'artistapasword';
    protected $primaryKey  = 'ID_Artistapasword'; 
}