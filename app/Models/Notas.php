<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    protected $table = 'notas';

    protected $primaryKey = 'id';
    
    protected $fillable = ['titulo', 'descripcion','usuario_id', 'etiqueta', 'fecha_vencimiento', 'imagen'];
}
