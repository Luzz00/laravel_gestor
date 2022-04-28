@extends("base")
@section("fx_body","onload=changeSelectValue()")
@section("contenido")

        <div class="row">
            <div class="col-12">
                <br/>
                <h4>Búsqueda</h4> <br/>
                <!--Buscar por:  nombre empresa, nombre técnico, fecha, provincia, ciudad-->
                <nav class="navbar navbar-light bg-light">
                    <form class="form-inline" action="{{route('incidencias.indexFiltro')}}" method="get">
                    @csrf
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Buscar por  </label>
                            <select class="form-control ml-2" id="filtro" name="filtro" onclick="changeInputType();">
                                <option value="">----</option>
                                <option value="empresas.nombre" >nombre Empresa</option>
                                <option value="tecnicos.nombre">nombre Técnico </option>
                                <option value="incidencias.fecha">fecha</option>
                                <option value="incidencias.provincia">provincia</option>
                                <option value="incidencias.ciudad">ciudad</option>
                                <option value="rangoFechas">rango de fechas</option>
                                <!--<option value="incidencias.id_empresa">id_empresa</option>-->
                            </select>
                        </div>
                    
                        <input class="form-control mr-sm-2 ml-2" type="search" placeholder="Search" aria-label="Search" id="valorBuscado" name="valorBuscado" value="{{$valorBuscado}}">
                        <input class="form-control mr-sm-2 ml-2" type="search" placeholder="Search" aria-label="Search" id="valorBuscado2" name="valorBuscado2" value="{{$valorBuscado_2}}" hidden>

                        <button class="btn btn-outline-info my-2 my-sm-0 ml-2" type="submit" >Search</button>

                    </form>
                    <br/>
                    <p id="filtro_devuelto" hidden>{{$filtro}}</p>
                    <!--<p id="texto">texto</p>-->
                </nav>
            </div>
        
        </div>


        <div class="row">
            <div class="col-12">
                @if($incidencias)
                <table class="table table-light table-striped table-bordered mt-4">
                    <thead style="background-color:#0080FF; color:white">
                        <tr id="tr_thead">
                            <th>id_incidencia</th>
                            <th>id_empresa</th>
                            <th>nombre_empresa</th>
                            <th>id_técnico</th>
                            <th>nombre_técnico</th>
                            <th>fecha</th>
                            <th>provincia</th>
                            <th>ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                            
                         @foreach($incidencias as $incidencia)
                            <tr>
                                    <td>{{$incidencia->id}}</td>
                                    <td>{{$incidencia->id_empresa}}</td>
                                    <td>{{$incidencia->nombre_empresa}}</td>
                                    <td>{{$incidencia->id_tecnico}}</td>
                                    <td>{{$incidencia->nombre_tecnico}}</td>
                                    <td>{{$incidencia->fecha}}</td>
                                    <td>{{$incidencia->provincia}}</td>
                                    <td>{{$incidencia->ciudad}}</td>
                            </tr>
                        @endforeach
                            
                    </tbody>
                </table>
                @else
                    <br/>
                    <p>No hay resultados</p>
                @endif
                
            </div>
        </div>
    </div>

    <script>
        //colocar input de fecha cuando el filtro seleccionadp sea una fecha
        function changeInputType(){
            let filtro= document.getElementById("filtro").value;
            let input= document.getElementById("valorBuscado");
            let input_2= document.getElementById("valorBuscado2");

            input.setAttribute("value","");
            input_2.setAttribute("value","");
            input_2.setAttribute("hidden","");

            if(filtro=="incidencias.fecha"){
                input.setAttribute("type","date");

                

            }else if(filtro=="rangoFechas"){
                //aparecer 2 inputs typo date, cambiar los placeholder
                input.setAttribute("type","date");
                input_2.setAttribute("type","date");

                //no se ven
                /*input.setAttribute("placeholder","fecha inicial")
                input_2.setAttribute("placeholder","fecha final")*/

                input_2.removeAttribute("hidden");
                
                
            }else{
                input.setAttribute("type","search");
                
            }

        }

        //colocar opcion de selected devuelto
        function changeSelectValue(){
            let filtro_devuelto= document.getElementById("filtro_devuelto").innerHTML;
            let selectLista= document.getElementById("filtro").children;

            let theadLista= document.getElementById("tr_thead").children;
            let input_2= document.getElementById("valorBuscado2");

            //document.getElementById("texto").innerHTML=filtro;
            //document.getElementById("texto").innerHTML=selectLista[1].value;

            for(let i=0; i<selectLista.length; i++){
                
                if(selectLista[i].value==filtro_devuelto){
                    selectLista[i].setAttribute("selected","selected");
                    //document.getElementById("texto").innerHTML=selectLista[i].value;
                }
            } 
        
            switch(filtro_devuelto){
                case "empresas.nombre": filtro_devuelto="nombre_empresa";
                    break;
                case "tecnicos.nombre": filtro_devuelto="nombre_técnico";
                    break;
                case "incidencias.fecha": filtro_devuelto="fecha";
                    break;
                case "incidencias.provincia": filtro_devuelto="provincia";
                    break;
                case "incidencias.ciudad": filtro_devuelto="ciudad";
                    break;
                case "rangoFechas": filtro_devuelto="fecha";
                    //mostrar el input 2
                    input_2.removeAttribute("hidden");

                break;
                default: filtro_devuelto="";
            }

            //cambiar el valor del filtro para que corresponda al nombre de las columnas
            for(let i=0; i<theadLista.length; i++){
                if(theadLista[i].innerHTML== filtro_devuelto){
                    //theadLista[i].style.backgroundColor="green";
                    theadLista[i].style.cssText="background-color:#2E64FE ";
                    //document.getElementById("texto").innerHTML=theadLista[i].innerHTML;
                    
                }
            } 
        }

    </script>
@endsection
