@extends('layouts.general')

@section('title_page', 'Crear menu')

@section('content_page')
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session('success') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card shadow p-3 mb-5 bg-body rounded">
    <div class="carrd-header">
        <div class="d-flex justify-content-between">
            <div>
                Completa los siguientes campos
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                    autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}"
                                    autocomplete="off" readonly required>
                                <span id="error_slug"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="url-interno">URL/Página</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="parent" id="radiobtnURL">
                                    <label class="form-check-label" for="radio-boton">
                                        URL
                                    </label>
                                    <input type="text" class="form-control" id="enlace" name="enlace" autocomplete="off">
                                </div>
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="parent" id="radiobtnURL">
                                    <label class="form-check-label" for="radio-boton">
                                        Página
                                    </label>
                                    <input type="text" class="form-control" id="enlace" name="enlace" autocomplete="off">
                                </div> --}}
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="parent" id="radiobtnHijo">
                                    <label class="form-check-label" for="radio-boton-hijo">
                                        Hijo
                                    </label>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="rol" class="form-label">Tipo</label>
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="radio" name="parent" id="radiobtnPadre"
                                        checked>
                                    <label class="form-check-label" for="radio-boton-hijo">
                                        Padre
                                    </label>
                                    <input type="number" class="form-control" id="inputbtnPadre" name="parent" value="0"
                                        autocomplete="off">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="parent" id="radiobtnHijo">
                                    <label class="form-check-label" for="radio-boton-hijo">
                                        Hijo
                                    </label>
                                </div> --}}
                                <select class="form-select" id="selectMenu" name="parent">
                                    <option value="0">Seleccionar menú</option>
                                    @foreach ($menus as $menu)
                                    @if ($menu->parent == 0)
                                    <option value="{{$menu->id}}" {{ old('parent') == $menu->id ? 'selected' : '' }}>
                                        {{$menu->name}}</option>
                                    @else
                                    <option value="{{$menu->id}}" {{ old('parent') == $menu->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;{{$menu->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="target" class="form-label">Target</label>
                                <select class="form-select" name="target" required>
                                    <option value="" selected>Seleccionar estado</option>
                                    <option {{ old('target') == '_blank' ? 'selected' : '' }} value="_blank">_blank</option>
                                    <option {{ old('target') == '_parent' ? 'selected' : '' }} value="_parent">_parent</option>
                                    <option {{ old('target') == '_self' ? 'selected' : '' }} value="_self">_self</option>
                                    <option {{ old('target') == '_top' ? 'selected' : '' }} value="_top">_top</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="estado" class="form-label">Activo</label>
                                <select class="form-select" name="enabled" required>
                                    <option value="" selected>Seleccionar estado</option>
                                    <option {{ old('enabled') == '1' ? 'selected' : '' }} value="1">Si</option>
                                    <option {{ old('enabled') == '0' ? 'selected' : '' }} value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Orden</label>
                                <input type="number" class="form-control w-50" id="order" name="order" value="{{ old('order') }}"
                                    autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="area" class="form-label">Página</label>
                                <select class="form-select" name="pagina_id" value="{{ old('pagina_id') }}">
                                    <option value="0" selected>Selecciona una página</option>
                                    @foreach ($paginas as $pagina)
                                        <option value="{{$pagina->id}}" {{ old('pagina_id') == $pagina->id ? 'selected' : '' }}>{{$pagina->titulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Crear</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection

@push('css')

@endpush

@push('js')
<script src="{{asset('assets/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/js/bootstrap.min.js"
    integrity="sha512-8Y8eGK92dzouwpROIppwr+0kPauu0qqtnzZZNEF8Pat5tuRNJxJXCkbQfJ0HlUG3y1HB3z18CSKmUo7i2zcPpg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
        
        // $("#radiobtnPadre").change(function () {	 
        // 	console.log('Padre');
        //     $('#selectbtnHijo').prop('disabled', true);
        //     $('#inputbtnPadre').prop('disabled', false);
        //     $('#inputbtnPadre').val('0');
        // });

        // $("#radiobtnHijo").change(function () {	 
        // 	console.log('Hijo');
        //     $('#inputbtnPadre').prop('disabled', true);
        //     $('#selectbtnHijo').prop('disabled', false);
        // });

        $('#selectMenu').on('change', function () {
            if (this.value == 0) {
                console.log('no contiene nada');
            } else if (!this.value == '' && !this.value == 0) {
                console.log('contiene algo ' + this.value);
            }
        });

        $('#name').stringToSlug({
            setEvents: 'keyup keydown blur',
            getPut: '#slug',
            space: '-'
        });

        $('#name').blur(function () {
            
            var error_slug = '';
            var slug = $('#slug').val();
            var _token = $('input[name="_token"]').val();
            var filter = /^[A-Za-z0-9]+(?:-[A-Za-z0-9]+)*$/;
            if ($.trim(slug).length > 0) {
                if (!filter.test(slug)) {
                    $('#error_slug').html(
                        '<label class="badge bg-warning text-dark">Slug Inválido</label>');
                    $('#slug').addClass('has-error');
                    $('#register').attr('disabled', 'disabled');
                } else {
                    $.ajax({
                        url: "{{ route('menu.register-check') }}",
                        method: "POST",
                        data: {
                            slug: slug,
                            _token: _token
                        },
                        success: function (result) {
                            if (result == 'unique') {
                                $('#error_slug').html(
                                    '<label class="badge bg-success text-white">Slug disponible </label>'
                                    );
                                $('#slug').removeClass('has-error');
                                $('#register').attr('disabled', false);
                            } else {
                                $('#error_slug').html(
                                    '<label class="badge bg-danger text-white">Slug no disponible</label>'
                                    );
                                $('#slug').addClass('has-error');
                                $('#register').attr('disabled', 'disabled');
                            }
                        }
                    })
                }
            } else {
                $('#error_slug').html(
                    '<label class="badge bg-info text-dark">Slug Requerido</label>');
                $('#slug').addClass('has-error');
                $('#register').attr('disabled', 'disabled');
            }
        });



    });

</script>

<script>
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
