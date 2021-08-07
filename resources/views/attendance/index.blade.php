@extends('layouts.adminlte')

@section('content')

<h3>Control de mis asistencias</h3>
<hr>


<div class="row">
    <div class="container">
    
        
        
        <div class="container row text-right">        
            <a href="/attendance/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Registrar asistencia</a>
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
                                <th>Día</th>
                                <th>Fecha de ingreso</th>
                                <th>Fecha de salida</th>
                                <th>Estado</th>
                                <th>Tiempo trancurrido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attendances as $attendance)
                                <tr>
                                    <td>{{$dias[$attendance->dia_semana]}}</td>
                                    <td>{{$attendance->created_at->format('d/m/Y h:i:s A')}}</td>
                                    @if ($attendance->estado == 1)
                                        <td>{{$attendance->updated_at->format('d/m/Y h:i:s A')}}</td>
                                        <td>
                                            <span class="label label-success"> Salida</span>
                                        </td>

                                    @else
                                        <td> <span class="label label-warning">Pendiente</span> </td>
                                        <td>
                                            <a href="/attendance/create" class="btn btn-sm btn-primary"> <i class="fa fa-clock-o"></i> Marcar salida </a>

                                            {{-- <span class="label label-warning">{{$attendance->estado}} Ingreso</span> --}}
                                        </td>
                                        
                                    @endif
                                    <td>
                                        {{ $attendance->created_at->diffInHours($attendance->updated_at)}} Horas                                       
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
</div>
@endsection