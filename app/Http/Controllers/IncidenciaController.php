<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Empresa;
use App\Models\Tecnico;

class IncidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $consulta=Incidencia::join("tecnicos","incidencias.id_tecnico","=","tecnicos.id")
            ->join("empresas","incidencias.id_empresa","=","empresas.id")
            ->select("incidencias.id","incidencias.id_empresa","empresas.nombre as nombre_empresa","incidencias.id_tecnico","tecnicos.nombre as nombre_tecnico",
            "incidencias.fecha","incidencias.provincia","incidencias.ciudad")
            ->get();//->paginate(1); devuelve solo el numero de registros indicado
        
        //return print($consulta);
        return view("incidenciasIndex")->with("incidencias",$consulta);

        //return view("incidenciasIndex");
    }

    public function indexFiltro(Request $request){

        
        $filtro= $request->get("filtro");

        $valorBuscado=$request->get("valorBuscado"); //trim($reqwuest...) para eliminar espacios en blanco
        $valorBuscado_2=$request->get("valorBuscado2");
        //averiguar si se trata de un rango de fecha

        if($valorBuscado){
            if($filtro){
                //si hay valor y filtro, realizamos la búsqueda. las incidenias pueden tener  o no resultado
                //$incidencias=Incidencia::where("provincia","like","%$valorBuscado%")->get();

                if($filtro=="rangoFechas" ){
                    if($valorBuscado_2){

                        $incidencias=Incidencia::join("tecnicos","incidencias.id_tecnico","=","tecnicos.id")
                                ->join("empresas","incidencias.id_empresa","=","empresas.id")
                                ->select("incidencias.id","incidencias.id_empresa","empresas.nombre as nombre_empresa","incidencias.id_tecnico","tecnicos.nombre as nombre_tecnico",
                                "incidencias.fecha","incidencias.provincia","incidencias.ciudad")
                                ->whereBetween("incidencias.fecha",["$valorBuscado","$valorBuscado_2"])
                                ->get();

                        if(sizeof($incidencias) <=0){ 
                            $incidencias=null;
                        }
                    }

                }else{

                    $incidencias=Incidencia::join("tecnicos","incidencias.id_tecnico","=","tecnicos.id")
                        ->join("empresas","incidencias.id_empresa","=","empresas.id")
                        ->select("incidencias.id","incidencias.id_empresa","empresas.nombre as nombre_empresa","incidencias.id_tecnico","tecnicos.nombre as nombre_tecnico",
                        "incidencias.fecha","incidencias.provincia","incidencias.ciudad")
                        ->where("$filtro","LIKE","%$valorBuscado%")
                        ->get();

                    if(sizeof($incidencias) <=0){ 
                        $incidencias=null;
                    }
                }

            }else{
                $incidencias=null;
                $valorBuscado="";
            }
            
        }else{
            //si no hay valorBuscado-> devolvemos todos los valores

            //$incidencias=Incidencia::all();
            $incidencias=Incidencia::join("tecnicos","incidencias.id_tecnico","=","tecnicos.id")
                ->join("empresas","incidencias.id_empresa","=","empresas.id")
                ->select("incidencias.id","incidencias.id_empresa","empresas.nombre as nombre_empresa","incidencias.id_tecnico","tecnicos.nombre as nombre_tecnico",
                "incidencias.fecha","incidencias.provincia","incidencias.ciudad")
                ->get();//->paginate(1); devuelve solo el numero de registros indicado
        }
       
        
        
        //return view("incidenciasFiltro")->with("incidencias",$incidencias);
        return view("incidenciasFiltro",compact("incidencias","filtro","valorBuscado","valorBuscado_2"));
        //return print($incidencias);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $incidencia= new Incidencia;
        $incidencia->id_empresa= $request->get("id_empresa");
        $incidencia->id_tecnico= $request->get("id_tecnico");
        $incidencia->fecha= $request->get("fecha");
        $incidencia->provincia= $request->get("provincia");
        $incidencia->ciudad= $request->get("ciudad");

        //return print($incidencia);
        $incidencia->save();
        return redirect()->route("tecnico.create");
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

    //mostrar por filtro
    public function find(Request $request, $incidencias=null){
        /*$valorBuscado= $request->get("valorBuscado");
        $filtro= $request->get("filtro");

        $incidencias=Incidencia::filtro($filtro,$valorBuscado);

        return  view("incidenciasFiltro")->with("incidencias",$incidencias);*/
        //return print($incidencias);

        $valorBuscado=$request->get("valorBuscado");
    
        $incidencias=Incidencia::where("provincia","like","%$valorBuscado%")->get();
        //return print($incidencias);
        return  view("incidenciasFiltro")->with("incidencias",$incidencias);
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
    public function update(Request $request, $id)
    {
        //
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
    }
}
