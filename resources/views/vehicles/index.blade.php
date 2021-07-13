@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de registros de Vehículos</h3>
    <hr>
    <div class="row">        
        <a href="/vehicles/create" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Placa</th>
                            <th>Conductor</th>
                            <th>DNI Conductor</th>
                            <th>Tipo Vehículo</th>
                            <th>Color</th>
                            <th>Motivo</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de salida</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{$vehicle->placa}}</td>
                                <td>{{$vehicle->conductor}}</td>
                                <td>{{$vehicle->dni_conductor}}</td>
                                <td>{{$vehicle->tipo_vehiculo}}</td>
                                <td>{{$vehicle->color}}</td>
                                <td>{{$vehicle->motivo}}</td>
                                <td>{{$vehicle->created_at}}</td>
                                <td>{{$vehicle->leave_at}}</td>
                                <td>
                                    @if ($vehicle->estado == 0)
                                        <a href="/vehicles/{{$vehicle->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        <span class="label label-success">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/vehicles/{{$vehicle->id}}/edit" class="btn btn-warning btn-sm">Editar</a></td>
                                <td><a href="/vehicles/{{$vehicle->id}}/confirmDelete" class="btn btn-danger btn-sm">Eliminar</a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $vehicles->render() !!}
            </ul>
        </div>



</div>
@endsection