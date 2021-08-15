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



    <h3>Gestión de registros de Administrativos</h3>
    <hr>
    <div class="container row text-right">        
        <a href="/administrative/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
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
                            <th>Fecha de ingreso</th>
                            <th>Fecha de salida</th>
                            <th>Observación</th>
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
                                <td>{{$item->created_at->format('d/m/Y h:i A')}}</td>
                                <td>
                                    @if ($item->estado == 0)
                                        <span class="label label-warning">Pendiente</span>                                  
                                    @else
                                        {{date('d/m/Y h:i A', strtotime($item->leave_at))}}                                        
                                    @endif
                                </td>
                                <td>
                                    @if ($item->descripcion != null)
                                        {{$item->descripcion}}
                                    @else
                                        <span class="label label-primary"><i class="fa fa-check-square-o"></i> Ninguna</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->estado == 0)
                                        <a href="/administrative/{{$item->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        <span class="label label-success">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/administrative/{{$item->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/administrative/{{$item->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
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