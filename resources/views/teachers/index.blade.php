@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de registros de docentes</h3>
    <hr>
    <div class="container row text-right">        
        <a href="/teachers/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>

    <div class="box">

        <!-- /.box-header -->
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
                            <th>Descripción</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->nombres}}</td>
                                <td>{{$teacher->apellidos}}</td>
                                <td>{{$teacher->dni}}</td>
                                <td>{{$teacher->created_at}}</td>
                                <td>{{$teacher->leave_at}}</td>
                                <td>{{$teacher->descripcion}}</td>
                                <td>
                                    @if ($teacher->estado == 0)
                                        <a href="/teachers/{{$teacher->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        <span class="label label-success">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/teachers/{{$teacher->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/teachers/{{$teacher->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $teachers->render() !!}
            </ul>
        </div>



</div>
@endsection