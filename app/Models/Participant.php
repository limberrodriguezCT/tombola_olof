<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre_completo',
        'centro_procedencia',
        'departamento',
        'tipo_procedencia',
    ];
}