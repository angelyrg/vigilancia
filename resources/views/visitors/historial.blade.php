@extends('layouts.adminlte')

@section('content')
<div class="container">

    
    <h4><b>{{$visits->first()->nombres." ".$visits->first()->apellidos}}</b><small> Historial de visitas </small></h3>  
    <hr>


    <div class="col-md-12 ">

        <div class="box box-primary">
            <div class="box-footer clearfix">
                <div class="pagination pagination-sm no-margin pull-right">
                    {!! $visits->render() !!}
                </div>
                <h4 >
                    <br>
                    Se muestran registros desde <span class="label label-info">{{$visits->first()->created_at->format('d/m/Y')}}</span> hasta <span class="label label-info">{{$visits->last()->created_at->format('d/m/Y')}}</span>     
                </h4> 
            </div>
        </div>


        <ul class="timeline">

            @foreach ($visits as $visit)

                <li class="time-label">
                    <span class="bg-green">
                        {{$visit->created_at->format('d/m/Y ')}}
                    </span>
                </li>

                <li>

                    <i class="fa fa-building bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{$visit->created_at->format('h:i:s A')}}</span>
            
                        <h3 class="timeline-header"><a href="/offices/{{$visit->oficina->id}}/historialOficinas">{{$visit->oficina->nombre_oficina}}</a></h3>
            
                        <div class="timeline-body">

                            <div class="row">
                                <div class="col-sm-2 text-right"><label >Motivo de visita</label></div>
                                <div class="col-sm-8 text-left"><p>{{$visit->motivo}}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-right"><label >Fecha de ingreso</label></div>
                                <div class="col-sm-8 text-left"><p>{{$visit->created_at->format('d/m/Y h:i A')}}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-right"><label >Fecha de salida</label></div>
                                @if ($visit->estado == 1)                                    
                                    <div class="col-sm-8 text-left"><p>{{ date('d/m/Y h:i A', strtotime($visit->leave_at)) }}</p></div>
                                @else
                                    <div class="col-sm-8 text-left"><p><span class="label label-warning">Pendiente</span></p></div>

                                    
                                @endif
                            </div>

                        </div>
            
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs" href="/offices/{{$visit->oficina->id}}/historialOficinas">Ver historial de visitas a esta oficina</a>
                        </div>
                    </div>
                </li>
                
            @endforeach

        </ul>
        
    </div>



</div>
@endsection