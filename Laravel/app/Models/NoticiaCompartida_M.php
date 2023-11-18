<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticiaCompartida_M extends Model
{
    use HasFactory; 

    public $timestamps = false;
    public $table = 'noticiascompartidas';
    public $primaryKey  = 'ID_NC';
    public $fillable = ['facebook', 'twitter', 'instagram', 'correo'];
}
