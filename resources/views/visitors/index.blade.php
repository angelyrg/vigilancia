@extends('layouts.adminlte')

@section('content')
<div class="container">

    @if (Session::has('messageNoHorario') )
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
            {{ Session::get("messageNoHorario")}}
        </div>
    @endif

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
                            <th>ID</th>
                            <th>Nombres y Apellidos</th>
                            <th>DNI</th>
                            <th>Fecha de ingreso</th>
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
                                <td>{{$visitor->id}}</td>
                                <td>                                    
                                    <a href="/visitors/{{$visitor->id}}/historialVisitantes" >{{$visitor->nombres." ".$visitor->apellidos}}</a>
                                </td>
                                
                                <td>{{$visitor->dni}}</td>
                                <td>{{$visitor->created_at->format('d/m/Y h:i A')}}</td>
                                @if ($visitor->estado == 1)
                                    <td>{{date('d/m/Y h:i A', strtotime($visitor->leave_at))}}</td>
                                @else
                                    <td><span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span></td>
                                @endif
                                <td>
                                    <a href="/offices/{{$visitor->oficina->id}}/historialOficinas" >{{$visitor->oficina->nombre_oficina }}</a>
                                </td>

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