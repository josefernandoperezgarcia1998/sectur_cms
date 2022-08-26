<?php

namespace App\Http\Controllers;

use App\Models\Pagina;
use App\Models\Archivo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class ArchivosPaginaController extends Controller
{
    public $paginaSeleccionada;
    public $paginaSeleccionadaSlug;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pagina $pagina)
    {
        $paginaActual = $pagina->id;
        $paginaSlug = $pagina->slug;
        $this->paginaSeleccionada = $paginaActual;
        $this->paginaSeleccionadaSlug = $paginaSlug;
        session()->put('paginaSelect', $paginaActual);
        session()->put('paginaSelectSlug', $paginaSlug);
        return view('paginas.archivos.index', compact('pagina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pagina $pagina)
    {
        return view('paginas.archivos.create', compact('pagina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pagina = Pagina::find($request->pagina_id);
        $archivoData = $request->all();

        $validated = $request->validate([
            'titulo' => 'required',
            'imagen' => 'mimes:jpg,jpeg,png',
            'documento' => 'mimes:doc,pdf,docx,xlsx',
            'estado' => 'required',
        ]);
        
        if($request->hasFile('imagen')){

            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
            // Tamaño de la imagen
            $imagenSize = $request->file('imagen')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
            $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Tipo de archivo (extension)
            $getImagen = $request->file('imagen');
            $imagenExtension = $getImagen->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_imagen'] = $imagenSizeFinal;
            $archivoData['type_imagen'] = $imagenExtension;

            $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');
        }

        if($request->hasFile('documento')){
            // Obteniendo el nombre del documento (haciendola unica)
            $documento = $request->file('documento');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
            // Obteniendo el tamaño del documento
            $documentSize = $request->file('documento')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
            $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Obteniendo el tipo de archivo (extension)
            $getDocument = $request->file('documento');
            $documentExtension = $getDocument->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_documento'] = $documentSizeFinal;
            $archivoData['type_documento'] = $documentExtension;

            $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');
        }

        if($request->hasFile('imagen') && $request->hasFile('documento')){
            // Nnombre de la imagen (haciendola unica)
            $imagen = $request->file('imagen');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
            // Tamaño de la imagen
            $imagenSize = $request->file('imagen')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
            $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Tipo de archivo (extension)
            $getImagen = $request->file('imagen');
            $imagenExtension = $getImagen->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_imagen'] = $imagenSizeFinal;
            $archivoData['type_imagen'] = $imagenExtension;

            $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

             // Obteniendo el nombre del documento (haciendola unica)
            $documento = $request->file('documento');
            $hora = Str::slug(date('h:i:s'),'_');
            $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
            // Obteniendo el tamaño del documento
            $documentSize = $request->file('documento')->getSize();
            $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
            $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
            // Obteniendo el tipo de archivo (extension)
            $getDocument = $request->file('documento');
            $documentExtension = $getDocument->getClientOriginalExtension();
            
            // Asignando el tamaño y tipo
            $archivoData['size_documento'] = $documentSizeFinal;
            $archivoData['type_documento'] = $documentExtension;

            $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');
        
        }

        Archivo::create($archivoData);

        return redirect()->route('paginas.archivos',$pagina)->with('success', 'Registro creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $archivo = Archivo::find($id);
        $pagina = Pagina::find(session('paginaSelect'));

        return view('paginas.archivos.edit', compact('archivo', 'pagina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $archivoData = $request->all();
        $pagina = Pagina::find($request->pagina_id);
        $archivo = Archivo::find($id);

        $validated = $request->validate([
            'titulo' => 'required',
            'imagen' => 'mimes:jpg,jpeg,png',
            'documento' => 'mimes:doc,pdf,docx,xlsx',
            'estado' => 'required',
        ]);

        // Si el request tiene una imagen se elimina la actual para almacenar la nueva
        if($request->hasFile('imagen')){
            
            if(is_null($archivo->imagen)){
                // Nnombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
            
                // Tamaño de la imagen
                $imagenSize = $request->file('imagen')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
                $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                
                // Tipo de archivo (extension)
                $getImagen = $request->file('imagen');
                $imagenExtension = $getImagen->getClientOriginalExtension();
                
                // Asignando el tamaño y tipo
                $archivoData['size_imagen'] = $imagenSizeFinal;
                $archivoData['type_imagen'] = $imagenExtension;

                $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');
                
            } elseif (Storage::exists($archivo->imagen)){

                // borrando la imagen del storage
                $archivoImagen = Archivo::findOrFail($id);
                Storage::delete($archivoImagen->imagen);
                
                // Nnombre de la imagen (haciendola unica)
                $imagen = $request->file('imagen');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
            
                // Tamaño de la imagen
                $imagenSize = $request->file('imagen')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
                $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                
                // Tipo de archivo (extension)
                $getImagen = $request->file('imagen');
                $imagenExtension = $getImagen->getClientOriginalExtension();
                
                // Asignando el tamaño y tipo
                $archivoData['size_imagen'] = $imagenSizeFinal;
                $archivoData['type_imagen'] = $imagenExtension;

                $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

            }
        }

        // Si el request tiene un docuumento se elimina el actual para almacenar el nuevo
        if($request->hasFile('documento')){

            if(is_null($archivo->documento)){
            
                // Obteniendo el nombre del documento (haciendola unica)
                $documento = $request->file('documento');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
                // Obteniendo el tamaño del documento
                $documentSize = $request->file('documento')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
                $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
                // Obteniendo el tipo de archivo (extension)
                $getDocument = $request->file('documento');
                $documentExtension = $getDocument->getClientOriginalExtension();
            
                // Asignando el tamaño y tipo
                $archivoData['size_documento'] = $documentSizeFinal;
                $archivoData['type_documento'] = $documentExtension;

                $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');

            } elseif (Storage::exists($archivo->documento)){
                // borrando la documento del storage
                $archivoDocumento = Archivo::findOrFail($id);
                Storage::delete($archivoDocumento->documento);

                // Obteniendo el nombre del documento (haciendola unica)
                $documento = $request->file('documento');
                $hora = Str::slug(date('h:i:s'),'_');
                $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
                // Obteniendo el tamaño del documento
                $documentSize = $request->file('documento')->getSize();
                $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
                $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
                // Obteniendo el tipo de archivo (extension)
                $getDocument = $request->file('documento');
                $documentExtension = $getDocument->getClientOriginalExtension();
            
                // Asignando el tamaño y tipo
                $archivoData['size_documento'] = $documentSizeFinal;
                $archivoData['type_documento'] = $documentExtension;

                $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');

            }

        }

        // Si el request contiene una imagen y un documento se eliminan los dos actuales y se guardan lso nuevos
        // if($request->hasFile('imagen') && $request->hasFile('documento')){

        //     // borrando la imagen y el documento del storage
        //     $archivo = Archivo::findOrFail($id);
        //     Storage::delete($archivo->imagen, $archivo->documento);

        //     // Nnombre de la imagen (haciendola unica)
        //     $imagen = $request->file('imagen');
        //     $hora = Str::slug(date('h:i:s'),'_');
        //     $nombre_de_imagen = $hora.'_'.$imagen->getClientOriginalName();
        
        //     // Tamaño de la imagen
        //     $imagenSize = $request->file('imagen')->getSize();
        //     $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        //     $power = $imagenSize > 0 ? floor(log($imagenSize, 1024)) : 0;
        //     $imagenSizeFinal = number_format($imagenSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
        //     // Tipo de archivo (extension)
        //     $getImagen = $request->file('imagen');
        //     $imagenExtension = $getImagen->getClientOriginalExtension();
            
        //     // Asignando el tamaño y tipo
        //     $archivoData['size_imagen'] = $imagenSizeFinal;
        //     $archivoData['type_imagen'] = $imagenExtension;

        //     $archivoData['imagen']= $request->file('imagen')->storeAs('uploads/paginas/archivos/imagenes', $nombre_de_imagen, 'public');

        //      // Obteniendo el nombre del documento (haciendola unica)
        //     $documento = $request->file('documento');
        //     $hora = Str::slug(date('h:i:s'),'_');
        //     $nombre_de_documento = $hora.'_'.$documento->getClientOriginalName();
            
        //     // Obteniendo el tamaño del documento
        //     $documentSize = $request->file('documento')->getSize();
        //     $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        //     $power = $documentSize > 0 ? floor(log($documentSize, 1024)) : 0;
        //     $documentSizeFinal = number_format($documentSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
            
        //     // Obteniendo el tipo de archivo (extension)
        //     $getDocument = $request->file('documento');
        //     $documentExtension = $getDocument->getClientOriginalExtension();
            
        //     // Asignando el tamaño y tipo
        //     $archivoData['size_documento'] = $documentSizeFinal;
        //     $archivoData['type_documento'] = $documentExtension;

        //     $archivoData['documento']= $request->file('documento')->storeAs('uploads/paginas/archivos/documentos', $nombre_de_documento, 'public');
        
        // }

        $archivo->update($archivoData);
        
        return redirect()->route('paginas.archivos', $pagina)->with('success', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // Obteniendo la colección del archivo junto con la imagen y el documento
        $archivo = Archivo::find($id);
        $imagen = $archivo->imagen;
        $documento = $archivo->documento;

        // Se obtiene la página a la que le perteneen los archivos para redireccionar a la vista del listado
        // Y poder mostrar correctamente el mensaje de éxito
        $pagina = Pagina::find($archivo->pagina_id);

        // Estas dos condiciones de abajo permite también eliminar dos archivos si 
        // Si existe una imagen la elimina del storage y el registro también
        if ($imagen){
            Storage::delete($imagen);
            Archivo::destroy($id);
        }

        // Si existe un doccumento lo elimina del storage y el registro también
        if($documento){
            Storage::delete($documento);
            Archivo::destroy($id);
        }


        return redirect()->route('paginas.archivos',$pagina)->with('success', 'Registro eliminado correctamente');
    }

    public function paginasArchivosDatatables()
    {
        $dataArchivosPagina = Archivo::where('pagina_id', session('paginaSelect'));
        return FacadesDataTables::eloquent($dataArchivosPagina)
                                ->addColumn('btn', 'paginas.archivos.actions')
                                ->rawColumns(['btn'])
                                ->toJson();
    }
}
