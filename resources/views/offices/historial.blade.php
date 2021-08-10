@extends('layouts.adminlte')

@section('content')
<div class="container">
    <h4><b>{{$office->nombre_oficina}}</b><small> Historial de visitas </small></h3>
    
    
    <hr>



    <div class="col-md-12 ">

        <div class="box box-primary">
            <div class="box-footer clearfix">
                <div class="pagination pagination-sm no-margin pull-right">
                    {!! $visitors->render() !!}
                </div>
                <h4 >
                    <br>
                    Se muestran registros desde <span class="label label-info">{{$visitors->first()->created_at->format('d/m/Y')}}</span> hasta <span class="label label-info">{{$visitors->last()->created_at->format('d/m/Y')}}</span>     
                </h4> 
            </div>
        </div>

        
        <ul class="timeline">


            @foreach ($visitors as $visitor)

                <li class="time-label">
                    <span class="bg-green">
                        {{$visitor->created_at->format('d/m/Y ')}}
                    </span>
                </li>

                <li>

                    <i class="fa fa-user bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> {{$visitor->created_at->format('h:i:s A')}}</span>
            
                        <h3 class="timeline-header"><a href="/visitors/{{$visitor->id}}/historialVisitantes">{{$visitor->nombres." ".$visitor->apellidos}}</a></h3>
            
                        <div class="timeline-body">

                            <div class="row">
                                <div class="col-sm-2 text-right"><label >DNI</label></div>
                                <div class="col-sm-8 text-left"><p>{{$visitor->dni}}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-right"><label >Motivo de visita</label></div>
                                <div class="col-sm-8 text-left"><p>{{$visitor->motivo}}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-right"><label >Fecha de ingreso</label></div>
                                <div class="col-sm-8 text-left"><p>{{$visitor->created_at->format('d/m/Y h:i A')}}</p></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-2 text-right"><label >Fecha de salida</label></div>
                                @if ($visitor->estado == 1)                                    
                                    <div class="col-sm-8 text-left"><p>{{ date('d/m/Y h:i A', strtotime($visitor->leave_at)) }}</p></div>
                                @else
                                    <div class="col-sm-8 text-left"><p><span class="label label-warning">Pendiente</span></p></div>

                                    
                                @endif
                            </div>

                        </div>
            
                        <div class="timeline-footer">
                            <a class="btn btn-primary btn-xs" href="/visitors/{{$visitor->id}}/historialVisitantes">Ver historial de visitas de esta persona</a>
                        </div>
                    </div>
                </li>
                
            @endforeach

        </ul>

       
        
    </div>



</div>
@endsection