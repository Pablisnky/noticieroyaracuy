<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos_M extends Model
{
    use HasFactory;

    protected $table = 'videos';
    protected $primaryKey  = 'ID_Video';
    // public $TimesTamp = false;
}
