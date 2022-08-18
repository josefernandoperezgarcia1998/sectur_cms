@extends('layouts.pagina.pagina-plantilla')

@section('contenido')
{{-- Para hacer que las imagenes sean responsivas en el ckeditor porque se desbordan--}}
<style>
    .contenedor > figure{
        text-align: center;
    }
    figure > img {
        max-width: 100%;
        height: auto !important;
    }
</style>
<div class="card" style="border:none;">
    @foreach ($pagina as $page)
        <div class="card-header">
            <h3 class="display-6">{{$page->titulo}}</h3>
        </div>
        <div class="container-fluid">
                @if (is_null($page->imagen_destacada) || $page->imagen_principal_estado == 'No')

                @else
                    <img src="{{asset('storage').'/'.$page->imagen_destacada}}" alt="imagen" class="img-fluid rounded mx-auto d-block">
                @endif
                <div class="contenedor">{!!$page->contenido!!}</div>
        </div>
    @endforeach
    <br>
    <table class="table">
        <tr>
            <th class="table-active">Fuente</th>
            <td>Unidad de Apoyo Administrativo / Área de Recursos Humanos</td>
        </tr>
        <tr>
            <th class="table-active">Actualización</th>
            <td>{{$page->updated_at->isoFormat('LLLL'),}}</td>
        </tr>
    </table>
</div>
@endsection