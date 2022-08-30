<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Archivo;
use App\Models\Footer;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Illuminate\Support\Str;

class PaginaController extends Controller
{
    public function index()
    {
        $paginas = Pagina::latest('created_at')->paginate(5);
        return view('paginas.index', compact('paginas'));
    }


    public function create()
    {
        return view('paginas.create');
    }

    public function store(Request $request)
    {

        // Se obtienen todos od datos del request
        $datosPagina = $request->all();

        /*

        Aquí poner las validaciones correspondientes

        */
        

        // Si existe una imagen destacada en el request se almacena en el storage
        if($request->hasFile('imagen_destacada'))
        {
            $hora = Str::slug(date('h:i:s A'),'_');
            $image = $request->file('imagen_destacada');
            $imageName = $hora.'_'.$image->getClientOriginalName();
            $datosPagina['imagen_destacada'] = $request->file('imagen_destacada')->storeAs('uploads/paginas/imagenes_destacadas', $imageName, 'public');
        }


        // Se crea la página con los valores del request
        $pagina = Pagina::create($datosPagina);

        // expresion regular para recuperar la imagen con ckeditor
        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extractImages, $datosPagina['contenido'], $matches);
        $images = $matches[1];

        // Se agregan las imagenes puestas en el ckeditor en la relacion de "images()" en el modelo de Pagina
        foreach ($images as $image) {
            $image_url = 'images/'.pathinfo($image, PATHINFO_BASENAME);

            $pagina->images()->create([
                'image_url' => $image_url,
            ]);
        }

        return redirect()->route('paginas.index')->with('success', 'Página creada correctamente');

    }

    public function edit(Pagina $pagina)
    {
        return view('paginas.edit', compact('pagina'));
    }

    public function update(Request $request, Pagina $pagina)
    {

        $pagina_data = $request->all();

        // La primer condición dice 
        //"Si al momento de actualizar el campo de imagen_destacada es NULL en la BD y si existe algo en el request de imagen_destacada
        //Va a guardar en la base de datos eso, ahora bien,
        // La segunda condición dice, si al momento de actualizar la información existe algo en el request, lo que hará es actualizar la
        // imagen que se tiene actualmente en le BD y la almacenará.
        if(($pagina->imagen_destacada == NULL) && ($request->hasFile('imagen_destacada'))){
            $hora = Str::slug(date('h:i:s A'),'_');
            $image = $request->file('imagen_destacada');
            $imageName = $hora.'_'.$image->getClientOriginalName();
            $pagina_data['imagen_destacada'] = $request->file('imagen_destacada')->storeAs('uploads/paginas/imagenes_destacadas', $imageName, 'public');
        } elseif ($request->hasFile('imagen_destacada')) {
            $hora = Str::slug(date('h:i:s A'),'_');
            $image = $request->file('imagen_destacada');
            $imageName = $hora.'_'.$image->getClientOriginalName();
            Storage::delete($pagina->imagen_destacada);
            $pagina_data['imagen_destacada'] = $request->file('imagen_destacada')->storeAs('uploads/paginas/imagenes_destacadas', $imageName, 'public');
        }

        // Si exisste una imagen destacada la elimina y sustituye con una nueva
        // if($request->hasFile('imagen_destacada')){
        //     $hora = Str::slug(date('h:i:s A'),'_');
        //     $image = $request->file('imagen_destacada');
        //     $imageName = $hora.'_'.$image->getClientOriginalName();
        //     Storage::delete($pagina->imagen_destacada);
        //     $pagina_data['imagen_destacada'] = $request->file('imagen_destacada')->storeAs('uploads/paginas/imagenes_destacadas', $imageName, 'public');
        // }

        // Inicio para cuando se actualice el nombre de una pagina , también se actualice en el menu

        $paginaSeleccionadaParaCambioNombreMenu = Pagina::find($pagina->id);
        $paginaSlug = $paginaSeleccionadaParaCambioNombreMenu->slug;
        $menuSeleccionadoParaCambioDeNombrePagina = Menu::where('nombre_pagina', $paginaSlug)->get();

        // En este ciclo almaceno y cambio los valores obtenidos del menu relacionado a la pagina con la que se creó
        foreach($menuSeleccionadoParaCambioDeNombrePagina as $menuSelect)
        {
            $menuId = $menuSelect->id;
            $menuNombre = $menuSelect->name;
            $menuSlug = $menuSelect->slug;
            $menuParent = $menuSelect->parent;
            $menuOrder = $menuSelect->order;
            $menuEnabled = $menuSelect->enabled;
            $menuEnlace = $menuSelect->enlace;
            $menutarget = $menuSelect->target;
            $menupaginaId = $menuSelect->pagina_id;
            $menuNombrePagina = $menuSelect->nombre_pagina;

            $arreglo = array(
                'id' => $menuId,
                'name' => $menuNombre,
                'slug' => $menuSlug,
                'parent' => $menuParent,
                'order' => $menuOrder,
                'enabled' => $menuEnabled,
                'enlace' => $menuEnlace,
                'target' => $menutarget,
                'pagina_id' => $menupaginaId,
                'nombre_pagina' => $request->slug,
            );

            $menu = Menu::find($menuId);
            $menu->fill($arreglo);
            $menu->save();
        }

        // Fin para cuando se actualice el nombre de una pagina , también se actualice en el menu

        // Se actualiza los datos de la página
        $pagina->update($pagina_data);
        
        $imagenes_antiguas = $pagina->images->pluck('image_url')->toArray();

        // expresion regular para recuperar las imagenes de la pagina que existen en el ckeditor
        $re_extractImages = '/src=["\']([^ ^"^\']*)["\']/ims';
        preg_match_all($re_extractImages, $pagina_data['contenido'], $matches);
        $imagenes_nuevas = $matches[1];

        foreach($imagenes_nuevas as $image)
        {
            $image_url = 'images/'.pathinfo($image, PATHINFO_BASENAME);

            $clave = array_search($image_url, $imagenes_antiguas);

            if($clave === false)
            {
                $pagina->images()->create([
                    'image_url' => $image_url,
                ]);
            } else {
                unset($imagenes_antiguas[$clave]);
            }
        }

        return redirect()->route('paginas.edit', $pagina)->with('success', 'Registro actualizado con éxito');
    }

    public function destroy(Pagina $pagina)
    {
        // dd($pagina->imagen_destacada);
        $pagina->delete();
        return redirect()->route('paginas.index')->with('success', 'Página eliminada correctamente');
    }

    /**
     * Función asíncrona que permite usar el datatables en el index
     */
    public function paginasDatatables()
    {
        return FacadesDataTables::eloquent(\App\Models\Pagina::orderBy('created_at', 'asc'))
                ->addColumn('btn', function(Pagina $pagina) {
                    return view('paginas.actions', compact('pagina'));
                })
                ->rawColumns(['btn'])
                ->toJson();
    }

    /**
     * Función que busca una página seleccionada y esta manda los datos de la seleccionada a una plantilla especial
     * Al igual que toma los valores del footer y los pasa a la misma plantilla
     */
    public function tipoPagina(Pagina $pagina)
    {

        // Obteneindo los valores de la pagina seleccionada para enviarlos a una vista dependiendo su tipo
        $pagina_seleccionada = Pagina::find($pagina)->first();
        $tipoPagina = $pagina_seleccionada->tipo_pagina;
        $paginas = Pagina::all();
        $pagina = Pagina::find($pagina);
        
        // Obteniendo el contenido de cada "sección del footer" para poder pasarlo a la plantilla de las paginas
        $contenidoFooterContacto = Footer::where('tipo', 1)->where('estado','Si')->get();
        $contenidoFooterRecurso = Footer::where('tipo', 2)->where('estado','Si')->get();
        $contenidoFooterRedes = Footer::where('tipo', 3)->where('estado','Si')->get();

        // Obteniendo si la pagina seleccionada contiene algun archivo
        $archivosPagina = Archivo::where('pagina_id', $pagina_seleccionada->id)
                                    ->where('estado', 'Si')
                                    ->get();
        // dd($archivosPagina);

        switch ($tipoPagina) {
            case 'pagina':
                return view('paginas.paginas-publicas.paginas-publicas', compact('pagina','paginas','contenidoFooterContacto', 'contenidoFooterRecurso', 'contenidoFooterRedes', 'archivosPagina'));
                break;
            case 'blog':
                return view('paginas.paginas-publicas.paginas-publicas', compact('pagina','paginas'));
                break;
            case 'galeria':
                echo 'Esta es la página para galeria';
                break;
            
            default:
                echo 'Entró al default, no existe';
                break;
        }
    }

    // Función para subir imagenes al servidor con ckeditor
    public function upload(Request $request)
    {
        $path = Storage::put('images', $request->file('upload'));

        return [
            'url' => Storage::url($path),
        ];
    }
}
