<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class MenuController extends Controller
{
    public function index()
    {
        return view('menu.index');
    }

    public function create()
    {
        // $arreglo1 = Menu::all()->toArray();
        // $arreglo2 = Pagina::all()->toArray();
        // $arreglos = array_merge($arreglo1, $arreglo2);
        // dd($arreglos);
        $menus = Menu::all();
        $paginas = DB::table('paginas')->orderBy('titulo','asc')->get();
        return view('menu.create', compact('menus','paginas'));
    }

    public function store(Request $request)
    {
        // Si del request pagina_id no contiene nada se envía
        if(!isset($request->pagina_id))
        {
            $valoresMenu = $request->all();
            $pagina_id = $request->pagina_id;
            $paginaNombre = Pagina::findOrFail($pagina_id);
            $slugPagina = $paginaNombre->slug;

            $valoresMenu['nombre_pagina'] = $slugPagina;

            Menu::create($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro creado correctamente');
        }
        elseif(isset($request->pagina_id))
        {
            $valoresMenu = $request->all();
            $pagina_id = $request->pagina_id;
            $paginaNombre = Pagina::findOrFail($pagina_id);
            $slugPagina = $paginaNombre->slug;

            $valoresMenu['nombre_pagina'] = $slugPagina;

            Menu::create($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro creado correctamente');
        }
        else
        {
            $valoresMenu = $request->all();
            $valoresMenu['pagina_id'] = null;
            $valoresMenu['nombre_pagina'] = null;

            Menu::create($valoresMenu);
            return redirect()->route('menus.index')->with('success', 'Registro creado correctamente');
        }
    }

    public function edit($id)
    {
        $menus = Menu::all();
        $menuData = Menu::findOrFail($id);
        
        return view('menu.edit', compact('menuData', 'menus'));
    }

    public function update(Request $request, $id)
    {
        $valoresMenu = $request->all();
        
        $menu = Menu::find($id);
        $menu->fill($valoresMenu);
        $menu->save();

        return redirect()->route('menus.index', $id)->with('success','Registro actualizado correctamente');
    }

    public function destroy($id)
    {
        try{
            $menu = Menu::findOrFail($id);
            $menu->delete();
            return redirect()->route('menus.index')->with('success', 'Registro eliminado correctamente');
        } catch (\Illuminate\Database\QueryException $e){
            return redirect()->route('menus.index')->with('error',$e->getMessage());
        }
    }

    public function menusDatatables()
    {
        return FacadesDataTables::eloquent(\App\Models\Menu::orderBy('name', 'asc'))
                ->addColumn('btn', 'menu.actions')
                ->rawColumns(['btn'])
                ->toJson();
    }

    function check(Request $request)
    {
        if($request->get('slug'))
        {
            $slug = $request->get('slug');

            $data = DB::table("menus")
                    ->where('slug', $slug)
                    ->count();

            if($data > 0)
            {
                echo 'not_unique';
            }
            else
            {
                echo 'unique';
            }
        }
    }

}
