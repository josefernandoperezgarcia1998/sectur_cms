<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagina extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'slug',
        'imagen_destacada',
        'contenido',
        'tipo_pagina',
        'estado',
        'imagen_principal_estado',
    ];

    public function getRouteKeyName(){
        return 'slug';
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Relacion para ckeditor y las imagenes
    public function images()
    {
        return $this->hasMany(ImagesCkeditor::class);
    }
    
    // protected function slug(): Pagina
    // {
    //     return Pagina::make(
    //         get: fn ($value) => ucfirst($value),
    //     );
    // }

    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
}
