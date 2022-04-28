
    @extends("base")
    @section("contenido")
        <br/>
        <h3>Incidencias</h3>
        <br/>
        <table class="table table-light table-striped mt-4">
            <thead>
                <th>id_incidencia</th>
                <th>id_empresa</th>
                <th>nombre_empresa</th>
                <th>id_técnico</th>
                <th>nombre_técnico</th>
                <th>fecha</th>
                <th>provincia</th>
                <th>ciudad</th>
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

@endsection
