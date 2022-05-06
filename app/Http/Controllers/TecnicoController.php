<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tecnico;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Aplicar filtro
        $valorBuscado= $request->get("valorBuscado");
        $filtro= $request->get("filtro");

        if(($valorBuscado) && ($filtro) ){
            //filtrar
            $tecnicos=Tecnico::where("$filtro","LIKE","%$valorBuscado%")
            ->get();

        }else{
            //devolver todo
            $tecnicos=Tecnico::all();
            $filtro="apellidos"; //que por defecto devuelva appellidos
        }

        //$tecnicos=Tecnico::all();
        $totalTecnicos=sizeof($tecnicos); //Tecnico::all()->count();, devuelve el num de todos los registros devueltos

        return view("tecnicos")->with("tecnicos",$tecnicos)
                            ->with("totalTecnicos",$totalTecnicos)
                            ->with("filtro_devuelto",$filtro)
                            ->with("valorBuscado",$valorBuscado);
                           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view("crearRegistros");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $tecnico= new Tecnico;
        $tecnico->nombre= $request->get("nombre");
        $tecnico->apellidos= $request->get("apellidos");
        $tecnico->ciudad= $request->get("ciudad");

        $tecnico->save();

        return redirect()->route("controller.create");
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
        /*$tecnico=Tecnico::find($id);
        return redirect()->route("tecnico.index")->with("tecnico",$tecnico); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)//$id
    {
        //
        /*dd($request);
        exit(); */
        $id= $request->get("id");
        $tecnico= Tecnico::find($id);
        $tecnico->nombre= $request->get("nombre");
        $tecnico->apellidos= $request->get("apellidos");
        $tecnico->ciudad= $request->get("ciudad");

        $tecnico->save();
        return redirect()->route("tecnico.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Tecnico::destroy($id);
        return redirect()->route("tecnico.index");
    }
}
