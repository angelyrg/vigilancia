@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Control de mis asistencias</h3>
    <hr>
    
    <div class="container row text-right">        
        <a href="/attendance/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Récord de asistencias</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Fecha de ingreso</th>
                            <th>Fecha de salida</th>
                            <th>Día</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{$attendance->created_at}}</td>
                                <td>{{$attendance->updated_at}}</td>
                                <td>{{$attendance->dia_semana}}</td>
                                <td>
                                    <span class="label label-info">{{$attendance->estado}}</span>
                                </td>
                                <td>
                                    <a href="/attendance/{{$attendance->id}}/edit" class="btn btn-success"> <i class="fa fa-clock-o"></i> Registrar salida </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $attendances->render() !!}
            </ul>
        </div>



</div>
@endsection