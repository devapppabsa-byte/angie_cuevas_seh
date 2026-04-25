<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brigada extends Model
{
    use HasFactory;

    protected $table = 'brigadistas';

    protected $fillable = ['nombre_completo', 'foto', 'telefono', 'brigada', 'planta', 'area'];
    
}
