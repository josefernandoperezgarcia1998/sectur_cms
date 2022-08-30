@extends('layouts.pagina.pagina-plantilla')

@section('title_page')
@foreach ($pagina as $page)
{{$page->titulo}}
@endforeach
@endsection

@section('contenido')
<div class="card" style="border:none;">
    {{-- Este ciclo es por si la pagina tiene información interna como imagen, algún contenido texto/imagen --}}
    @foreach ($pagina as $page)
    <div class="card-header">
        <div class="d-flex justify-content-between">
            <div>
                <h1 class="display-6">{{$page->titulo}}</h1>
            </div>
            <div class="pt-3 d-flex">
                <div>
                    <input type="text" id="buscador" class="form-control" style="display: none;">
                </div>
                <div>
                    <svg id="iconoBuscador" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </div>
                
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (is_null($page->imagen_destacada) || $page->imagen_principal_estado == 'No')

        @else
        <img src="{{asset('storage').'/'.$page->imagen_destacada}}" alt="imagen"
            class="img-fluid rounded mx-auto d-block">
        @endif
        <hr>
        <div class="contenedor">{!!$page->contenido!!}</div>
    </div>
    @endforeach
    {{-- Este ciclo es para recorrer todos los archivos de la página actual --}}
    <div class="px-5" id="contenidoArchivos">
        @forelse ($archivosPagina as $archivo)
            @if (!is_null($archivo->documento))
                <p>
                    <a class="enlace-titulo" href="{{asset('storage').'/'.$archivo->documento}}" title="Descargar"
                        download="{{$archivo->titulo}}" target="_blank">{{$archivo->titulo}}</a>
                    &nbsp;-&nbsp;
                    <a class="enlace" style="rgb(166, 75, 10);" href="{{asset('storage').'/'.$archivo->documento}}"
                        title="Descargar" download="{{$archivo->titulo}}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                        </svg>
                    </a>
                </p>
                <div>
                    <div class="d-flex">
                        <small class="text-black-50">Tamaño: {{$archivo->size_documento}}</small>&nbsp;&nbsp;&nbsp;&nbsp;
                        <small class="text-black-50">Formato: {{$archivo->type_documento}}</small>
                    </div>
                </div>
                <hr>
            @endif
            
            @if (!is_null($archivo->imagen))
                <p>
                    <a class="enlace-titulo" href="{{asset('storage').'/'.$archivo->imagen}}" title="Descargar"
                        download="{{$archivo->titulo}}" target="_blank">{{$archivo->titulo}}</a>
                    &nbsp;-&nbsp;
                    <a class="enlace" style="rgb(166, 75, 10);" href="{{asset('storage').'/'.$archivo->imagen}}"
                        title="Descargar" download="{{$archivo->titulo}}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path
                                d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                        </svg>
                    </a>
                </p>
                <div>
                    <div class="d-flex">
                        <small class="text-black-50">Tamaño: {{$archivo->size_imagen}}</small>&nbsp;&nbsp;&nbsp;&nbsp;
                        <small class="text-black-50">Formato: {{$archivo->type_imagen}}</small>
                    </div>
                </div>
                <hr>
            @endif

            @if (!is_null($archivo->enlace))
                <p>
                    <a class="enlace-titulo" href="https://{{ $archivo->enlace }}" title="Visitar {{$archivo->title}}" target="_blank">{{$archivo->titulo}}</a>
                    &nbsp;-&nbsp;
                    <a class="enlace" style="rgb(166, 75, 10);" href="https://{{ $archivo->enlace }}" title="Visitar {{$archivo->title}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>
                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>
                        </svg>
                    </a>
                </p>
                <hr>
            @endif

        @empty
        
        @endforelse
    </div>
    <div class="px-5" id="contenidoArchivoBuscador" style="display: none;">
        <p>Resultados encontrados de la búsqueda: <small id="contador"></small></p>
        <div id="resultado">
        </div>
    </div>
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

@push('css')
<style>
    /* 
    Para hacer que las imagenes sean responsivas en el ckeditor porque se desbordan 
    */
    .contenedor>figure {
        text-align: center;
    }

    figure>img {
        max-width: 100%;
        height: auto !important;
    }

    /*
    Esto de abajo es lara los colores de los enlaces de los archivos
    */

    .enlace {
        color: #7c653d;
    }

    .enlace:hover {

        color: #FA9F01;
    }

    .info-archivo {
        color:
    }

    .enlace-titulo {
        color: #575654;
        text-decoration: none;
    }

    .enlace-titulo:hover {
        color: #000000;
    }

    /* icono del buscador */
    #iconoBuscador {
        cursor: pointer;
    }

</style>
@endpush

@push('js')

<script>
    let iconoBuscador = $('#iconoBuscador');
    let buscador = $('#buscador');
    
    let _token =  $('meta[name="csrf-token"]').attr('content');
    console.log(_token);

    $(iconoBuscador).click(function() {
        $(buscador).slideToggle('slow', function() {
            if($(buscador).is(':visible')){
                console.log('está visible');

                $(buscador).keyup(function(){
                    // console.log($(this).val());
                    if($(this).val().length == 0){
                        // console.log('esta vacio');
                        $('#contenidoArchivos').css('display', 'block');
                    }
                    else if($(this).val().length >= 0) {
                        let titulo = $('#buscador').val();
                        $('#contenidoArchivos').css('display', 'none');
                        $('#contenidoArchivoBuscador').css('display', 'block');
                        // logica aqui para ajax y mandar a llamar al info....
                    
                    }
                });
            }
            if($(buscador).is(':hidden')){
                console.log('no está visible');
            }
        });
    });
</script>

@endpush
