
@extends("base")
@section("contenido")
        <div class="row">
            <div class="col-12">
                <h3>Datos</h3><br/>
                <h4>Empresas</h4>
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
                            <a href="" class="btn btn-info">Editar</a>
                            <button type="submit" class="btn btn-danger">Borrar</button>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        

@endsection
