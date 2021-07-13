@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de registros de Administrativos</h3>
    <hr>
    <div class="row">        
        <a href="/administrative/create" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="box">
        {{-- <div class="box-header with-border">
            <h3 class="box-title">Registro de registros de administrativos</h3>
        </div> --}}
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
                        @foreach ($administrative as $item)
                            <tr>
                                <td>{{$item->nombres}}</td>
                                <td>{{$item->apellidos}}</td>
                                <td>{{$item->dni}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->leave_at}}</td>
                                <td>{{$item->descripcion}}</td>
                                <td>
                                    @if ($item->estado == 0)
                                        <a href="/administrative/{{$item->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        <span class="label label-success">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/administrative/{{$item->id}}/edit" class="btn btn-warning btn-sm">Editar</a></td>
                                <td><a href="/administrative/{{$item->id}}/confirmDelete" class="btn btn-danger btn-sm">Eliminar</a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $administrative->render() !!}
            </ul>
        </div>



</div>
@endsection