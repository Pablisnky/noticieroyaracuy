<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodistas_M extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'periodistas';
    protected $primaryKey  = 'ID_Periodista'; 
}
