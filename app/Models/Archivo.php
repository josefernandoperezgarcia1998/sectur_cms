<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'imagen',
        'documento',
        'descripcion',
        'size_documento',
        'type_documento',
        'size_imagen',
        'type_imagen',
        'enlace',
        'estado',
        'pagina_id',
    ];

    public function pagina()
    {
        return $this->belongsTo(Pagina::class);
    }

}
