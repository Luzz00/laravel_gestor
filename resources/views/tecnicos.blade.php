@extends("base")
@section("fx_body","onload=changeSelectValue()")
@section("contenido")
<div class="row ">
    <div class="col-5" style="border-right: 1px solid grey;">
        <br/>     
        <h4>Técnicos</h4><br/>
        
        <form class="form-inline" action="{{route('tecnico.index') }}" method="get">
            @csrf
            <input class="form-control " type="search" placeholder="Search" aria-label="Search" name="valorBuscado"  value={{$valorBuscado}}>
            <div class="form-group">
                <select class="form-control" id="filtro" name="filtro" onclick="changeInputType();">
                    <option value="">Filtro</option>
                    <option value="nombre">nombre</option>
                    <option value="apellidos">apellidos</option>
                    <option value="ciudad">ciudad</option>
                </select>
            </div>    

            <button class="btn btn-outline-info my-2 my-sm-0 ml-0" type="submit" >Search</button>

        </form>
        <p id="filtro_devuelto" hidden>{{$filtro_devuelto}}</p>
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
        <br/>
        <div class="justify-content-center">
            <a href="{{route('controller.create') }}" class="btn btn-success" >+ Agregar</a>
        </div><br/><br/>
        <h4 id="texto_alternativo"> Datos </h4>
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
                <tr>
                    <td>Acciones</td>
                    <td>
                        <a href="" class="btn btn-info" data-toggle="modal" 
                        data-target="#editModal">Editar</a>

                        <button type="submit" class="btn btn-danger" data-toggle="modal" 
                        data-target="#deleteModal" data-id="" name="">Borrar</button><!--le pasamos al botón el id -->
                    </td>
                </tr>
                
            </tbody>
        </table>

        <!--<p id="texto">texto</p>-->
    </div>

</div>

<div class="row">
    <!-- modal delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>¿Estas seguro de eliminar el registro? </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              
              <!-- formulario para eliminar-->
              <form action="{{route('tecnico.delete',0)}}" data-action="{{route("tecnico.delete", 0)}}" method="post" id="deleteForm">
                @csrf
                @method("DELETE")
                <button type="submit" class="btn btn-danger">Eliminar</button>
              </form> 
            </div>
          </div>
        </div>
    </div>
    <!-- fin: modal delete-->

    <!--modal edit -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar Técnico</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{route('tecnico.update') }}" method="post" id="editForm">
                    @csrf
                    @method("PUT")
                    <div class="form-group ">
                        <label for="id">Id</label>
                        <input type="text" class="form-control" id="id" name="id" value="" readonly>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" value="">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>

                </form>
            </div>

        </div>
        </div>
    </div>

</div>

<script>
    //datos a rellenar de tabla de datos
    let nombre=document.querySelectorAll("thead span")[0];
    let valor_filtro=document.querySelectorAll("thead span")[1];
    let apellidos=document.querySelectorAll("#tbody_rellenar td")[1];
    let id=document.querySelectorAll("#tbody_rellenar td")[3];
    let ciudad=document.querySelectorAll("#tbody_rellenar td")[5];
    let btns=document.querySelectorAll("#tbody_rellenar td")[7];

    //que se puestre texto o tabla de datos
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
        btns.children[1].setAttribute("data-id",id.innerHTML);//btn delete
    }

    function changeInputType(){
        //quitar el valorbuscado del input
        let input= document.getElementsByName("valorBuscado")[0];
        input.setAttribute("value","");
    }
    //colocar el selected devuelto
    function changeSelectValue(){
        let filtro_devuelto= document.getElementById("filtro_devuelto").innerHTML;
        let selectOptions= document.getElementById("filtro").children;
        let valorBuscado= document.getElementsByName("valorBuscado")[0];//sólo si hay valor buscado se coloca el select devuelto
        
        //buscar el filtro y seleccinarlo, sólo si hay un valor buscado
        if(valorBuscado.value){
            valorBuscado.style.cssText="color:grey";

            for(let i=0; i<selectOptions.length; i++){
                if(selectOptions[i].value== filtro_devuelto){
                    selectOptions[i].setAttribute("selected","selected");
                }
            }
        }
        
    }

</script>
@endsection

@section("script")
<!--Este script tiene que ir por debajo de los script que coloca boostrap para que exist ala libreria prieor y luego se haga su uso -->
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.attr("data-id"); // Extract info from data-* attributes

        //___COLOCAR en la url del form el id que se va apasar
        //obtener la url del form, valor de action. usar el data-action en lugar del action, 
        //porque el que se va a modificar y se va a quitar el ultimo valor, va a ser sólo éste. Esto para quitar siempre un valor (ya que el este valor siempre es el mismo, el valro que cambia es el del action), 
        //si no da error cuando se llega a num con 2 cifras, donde solo se elimina el ultimo y se queda e l 1º
        var action = $("#deleteForm").attr("data-action").slice(0,-1); //optener la ruta y quitarle el último valor (el id)
        //le concateno el id a la ruta
        action += id;
        //cambio el atributo de action, por la url creada
        $("#deleteForm").attr("action",action);
        console.log(action);

        var modal = $(this);
        //mensaje en el body
        modal.find('.modal-title').text('Se va a eliminar el registro: ' + id);
        
    })

    //datos a rellenar
    var inputs=$("#editForm input");

    $('#editModal').on('show.bs.modal', function (event) {

        //___Rellenar el modal con los datos acuales
        
        //console.log(inputs[2]);//el 0->token, el 1->method put, el 2->id

        //datos cogidos de la tabla de datos
        var nombre=$("#table_datos td span")[0];
        var tds= $("#tbody_rellenar td");
        
        //id, nombre, apellidos, ciudad
        inputs[2].value= tds[3].innerHTML;
        inputs[3].value= nombre.innerHTML
        inputs[4].value= tds[1].innerHTML;;
        inputs[5].value= tds[5].innerHTML;;
    })


</script>
@endsection