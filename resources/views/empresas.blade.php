
@extends("base")
@section("contenido")
        <div class="row">
            <div class="col-12">
                <br/>
                <h4>Empresas</h4><br/>
                <a href="{{route('controller.create') }}" class="btn btn-success" >+ Agregar</a><br/><br/>
                <!--mensaje de alerta -->
                @if(session("flash"))
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Aviso!</strong> {{session("flash")}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                
                <table class="table table-light table-striped mt-5">
                    <thead >
                    <tr>
                        <th scope="col" >id_empresa</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">CIF</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($empresas as $empresa)
                    <tr>
                        <td>{{$empresa->id }}</td>
                        <td>{{$empresa->nombre }}</td>
                        <td>{{$empresa->CIF }}</td>
                        <td>

                            <a href="" class="btn btn-info" data-toggle="modal" 
                            data-target="#editModal{{$empresa->id}}">Editar</a>

                            <!--pasamos al botón el id -->
                            <button type="submit" class="btn btn-danger" data-toggle="modal" 
                                data-target="#deleteModal" data-id="{{$empresa->id}}">Borrar</button>
                            
                            <!--ruta ( nombre ruta), parametro -->
                            <!-- <form action="{route("empresa.delete", $empresa->id)}}" method="post">
                                csrf
                                method("DELETE")
                            </form> -->

                            <!--modal edit -->
                            <div class="modal fade" id="editModal{{$empresa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Empresa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route("empresa.update",$empresa->id)}}" method="post" id="editForm">
                                        @csrf
                                        @method("PUT")

                                        <div class="form-group ">
                                            <label for="id">Id</label>
                                            <input type="text" class="form-control" id="id" name="id" value="{{$empresa->id}}" readonly>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre"  value="{{$empresa->nombre}}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="cif">CIF</label>
                                                <input type="text" class="form-control" id="cif" name="cif"  value="{{$empresa->CIF}}">
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>

                                    </form>
                                    </div>

                                </div>
                                </div>
                            </div>
                            
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                <!--colocar paginación automatica, sale my desajustado
                {$empresas->links()} -->
            </div>
        </div>

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
                  <form action="{{route("empresa.delete", 0)}}" data-action="{{route("empresa.delete", 0)}}" method="post" id="deleteForm">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        <!-- fin: modal delete-->
        
   

@endsection


@section("script")
<!--Este script tiene que ir por debajo de los script que coloca boostrap para que exist ala libreria prieor y luego se haga su uso -->
<script>
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        
        //___COLOCAR en la url del form el id que se va apasar
        //obtener la url del form, valor de action. usar el data-action en lugar del action, 
        //porque el que se va a modificar y se va a quitar el ultimo valor, va a ser sólo éste. Esto para quitar siempre un valor (ya que el este valor siempre es el mismo, el valro que cambia es el del action), 
        //si no da error cuando se llega a num con 2 cifras, donde solo se elimina el ultimo y se queda e l 1º
        var action = $("#deleteForm").attr("data-action").slice(0,-1); //optener la ruta y quitarle el último valor (el id)
        //le concateno el id a la ruta
        action += id;
        //cambio el atributo de action, por la url creada
        $("#deleteForm").attr("action",action);
        //console.log(action);

        var modal = $(this);
        //mensaje en el body
        modal.find('.modal-title').text('Se va a eliminar el registro: ' + id);
        
    })


</script>
@endsection
