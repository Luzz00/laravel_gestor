


@extends("base")
@section("contenido")
        
    <div class="row">
        <div class="col-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                        aria-selected="true">Crear empresa</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                        aria-selected="false">Crear técnico</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                        aria-selected="false">Crear Incidencia</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <br/>
                        <h3 class="">Crear Empresa</h3>
                        <br/>

                        <form action="{{route('empresa.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cif">CIF</label>
                                    <input type="text" class="form-control" id="cif" name="cif">
                                </div>
                            </div>
        
        
                        
                            <button type="submit" class="btn btn-primary" >Submit</button>
        
                        </form>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <br/>
                        <h3 class="">Crear Técnico</h3>
                        <br/>

                        <form action="{{route('tecnico.store') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos">
                                </div>
                            </div>
        
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
        
                        
                            <button type="submit" class="btn btn-primary" >Submit</button>
        
                        </form>
                      
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <br/>
                        <h3 class="">Crear Incidencia</h3>
                        <br/>
                        <form action="{{route('incidencia.store') }}" method="post">
                            @csrf
                        
                            <div class="form-group ">
                                <label for="id_empresa">id_empresa</label>
                                <input type="number" class="form-control" id="id_empresa" name="id_empresa">
                            </div>
        
                            <div class="form-group">
                                 <label for="id_tecnico">id_tecnico</label>
                                <input type="number" class="form-control" id="id_tecnico" name="id_tecnico">
                            </div>
        
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha">
                            </div>
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia">
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad">
                            </div>
        
                        
                            <button type="submit" class="btn btn-primary" >Submit</button>
        
                        </form>
                    </div>
                </div>

         </div>

    </div>

@endsection
