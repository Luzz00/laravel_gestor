@extends("base")
@section("contenido")
<div class="row">
    <div class="col-5" style="border-right: 1px solid grey;">
              
        <form class="form-inline" action="{{route('tecnico.index') }}" method="get">
            @csrf
            <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="valorBuscado">
            <div class="form-group">
                <select class="form-control" id="filtro" name="filtro">
                    <option value="">Filtro</option>
                    <option value="nombre">nombre</option>
                    <option value="apellidos">apellidos</option>
                    <option value="ciudad">ciudad</option>
                </select>
            </div>    

            <button class="btn btn-outline-info my-2 my-sm-0 ml-2" type="submit" >Search</button>

        </form>
        <br/>
        <table class="table table-hover">
            <thead>
                <tr >
                    <th>{{$totalTecnicos}} resultados<br/><br/></th>
                    
                </tr>
                
            </thead>
            <tbody>
                @foreach($tecnicos as $tecnico)
                <tr onclick="getData(event);">
                    <td>
                        <span>{{$tecnico->nombre}}</span><br/>
                        <!--Que coincida con el filtro buscado -->
                        <span style="font-size:12px;">{{$tecnico->$filtro_devuelto}}</span>
                    </td>
                    <td hidden>{{$tecnico->apellidos}}</td>
                    <td hidden>{{$tecnico->id}}</td>
                    <td hidden>{{$tecnico->ciudad}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <br/>
        <br/>
    </div>
    <!-- Tabla de todo los datos-->
    <div class="col-7">
        <h3 class="text-center" id="texto_alternativo"> Datos técnico </h3>
        <table class="table hidden" id="table_datos">
            <thead>
                <tr class="table-primary">
                    <td>
                        <span style="font-size:25px; font-weigth:bold">Nombre</span><br/>
                        <span style="font-size:15px;">ciudad</span>
                        <br/><br/>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
            <tbody id="tbody_rellenar">
                
                <tr>
                    <td>Apellidos</td>
                    <td>valor</td>
                </tr>
                <tr>
                    <td>id</td>
                    <td>valor</td>
                </tr>
                <tr>
                    <td>Ciudad</td>
                    <td>valor</td>
                </tr>
                
            </tbody>
        </table>

        <!--<p id="texto">texto</p>-->
    </div>
</div>

<script>
    //datos a rellenar
    let nombre=document.querySelectorAll("thead span")[0];
    let valor_filtro=document.querySelectorAll("thead span")[1];
    let apellidos=document.querySelectorAll("#tbody_rellenar td")[1];
    let id=document.querySelectorAll("#tbody_rellenar td")[3];
    let ciudad=document.querySelectorAll("#tbody_rellenar td")[5];

    let table_datos= document.getElementById("table_datos");
    let texto= document.getElementById("texto_alternativo");

    function getData(e){
        //que se vea la tabla de datos
        texto.classList.add("hidden");
        table_datos.classList.remove("hidden");

        //console.log(eventObj.currentTarget); //target ->devuelve la td visible, currentTraget->tr
        //datos a coger
        let tds= e.currentTarget.children;
        
        //document.getElementById("texto").innerHTML=tds[0].children;
        nombre.innerHTML=tds[0].children[0].innerHTML;
        valor_filtro.innerHTML=tds[0].children[2].innerHTML;

        apellidos.innerHTML=tds[1].innerHTML;
        id.innerHTML=tds[2].innerHTML;
        ciudad.innerHTML=tds[3].innerHTML;
    }
</script>
@endsection