@extends("base")
@section("contenido")
<div class="row">
    <div class="col-5" style="border-right: 1px solid grey;">
              
        <form class="form-inline" action="" method="get">
            @csrf
            <input class="form-control " type="search" placeholder="Search" aria-label="Search">
            <div class="form-group">
                <select class="form-control" id="filtro" name="filtro">
                    <option value="">Filtro</option>
                    <option value="">nombre</option>
                    <option value="">apellidos</option>
                    <option value="">ciudad</option>
                </select>
            </div>    

            <button class="btn btn-outline-info my-2 my-sm-0 ml-2" type="submit" >Search</button>

        </form>
        <br/>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>{{$totalTecnicos}} resultados<br/><br/></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tecnicos as $tecnico)
                <tr>
                    <td>
                        <span>{{$tecnico->nombre}}</span><br/>
                        <span style="font-size:12px;">{{$tecnico->ciudad}}</span>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <br/>
        <br/>
    </div>

    <div class="col-7">
        <table class="table ">
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
            <tbody>
                <tr>
                    <td  >Apellidos</td>
                    <td>valor</td>
                </tr>
                <tr>
                    <td>id</td>
                    <td>valor</td>
                </tr>
                <tr>
                    <td  >Ciudad</td>
                    <td>valor</td>
                </tr>

            </tbody>
        </table>

    </div>
</div>
@endsection