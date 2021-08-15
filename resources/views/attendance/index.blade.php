@extends('layouts.adminlte')

@section('content')

<h3>Control de mis asistencias</h3>
<hr>




<div class="row">
    <div class="container">

        @if (Session::has('message') )
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
                {{ Session::get("message")}}
            </div>
        @endif

        @if (Auth::user()->role_id != 1)

            <div class="container row text-right">        
                <a href="/attendance/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Registrar asistencia</a>
            </div>
            
        @endif
                
    
    
    
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
                                    <td>{{$attendance->id}}</td>
                                    <td>{{$attendance->created_at->format('d/m/Y h:i:s A')}}</td>
                                    @if ($attendance->estado == 1)
                                        <td>{{$attendance->updated_at->format('d/m/Y h:i:s A')}}</td>
                                        <td>
                                            <span class="label label-success"> Salida</span>
                                        </td>

                                    @else
                                        <td> <span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span> </td>
                                        <td>
                                            @if (Auth::user()->role_id == 1)
                                                <span class="label label-info">En el trabajo</span>
                                            @else                                            
                                                <a href="/attendance/create" class="btn btn-sm btn-primary">  Marcar salida <i class="fa fa-arrow-right"></i> </a>
                                            @endif
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