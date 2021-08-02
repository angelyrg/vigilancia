@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h4>Gestión de registros de Visitantes</h4>
    <hr>
    <div class="container row text-right">        
        <a href="/visitors/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de salida</th>
                            <th>Oficina</th>
                            <th>Motivo</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visitors as $visitor)
                            <tr>
                                <td>{{$visitor->nombres}}</td>
                                <td>{{$visitor->apellidos}}</td>
                                <td>{{$visitor->dni}}</td>
                                <td>{{$visitor->created_at}}</td>
                                <td>{{$visitor->leave_at}}</td>
                                <td>{{$visitor->oficina->nombre_oficina }}</td>
                                <td>{{$visitor->motivo}}</td>
                                <td>
                                    @if ($visitor->estado == 0)
                                        <a href="/visitors/{{$visitor->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        <span class="label label-success">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/visitors/{{$visitor->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/visitors/{{$visitor->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $visitors->render() !!}
            </ul>
        </div>



</div>
@endsection