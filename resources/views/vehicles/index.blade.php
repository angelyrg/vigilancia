@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de registros de Vehículos</h3>
    <hr>
    <div class="container row text-right">        
        <a href="/vehicles/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
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
                            <th>Propietario</th>
                            <th>Motivo</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de salida</th>
                            <th>Ubicación</th>
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
                                <td>
                                    @if ($vehicle->propiedad_epis)
                                        EPIS
                                    @else
                                        Externo
                                    @endif
                                    
                                <td>{{$vehicle->motivo}}</td>
                                <td>{{$vehicle->created_at->format('d/m/Y h:i A')}}</td>
                                <td>
                                    @if ($vehicle->leave_at == null)
                                        <a href="/vehicles/{{$vehicle->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        {{date('d/m/Y h:i A', strtotime($vehicle->leave_at))}}
                                    @endif
                                </td>

                                <td>
                                    @if ($vehicle->estado == 0)
                                        <span class="label label-success">Campus EPIS</span> 
                                    @else
                                        <span class="label label-default">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/vehicles/{{$vehicle->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/vehicles/{{$vehicle->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
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