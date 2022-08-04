<?php

namespace App\Http\Controllers;

use App\Models\Menu;
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
        $menus = Menu::all();
        return view('menu.create', compact('menus'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $valoresMenu = $request->all();
        Menu::create($valoresMenu);
        return redirect()->route('menus.index')->with('success', 'Registro creado correctamente');
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
