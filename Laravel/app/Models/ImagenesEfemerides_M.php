<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesEfemerides_M extends Model
{
    use HasFactory;

    public $TimesTamp = true;
    protected $table = 'imagenesefemerides';
    protected $primaryKey  = 'ID_ImagenEfemeride';
}
