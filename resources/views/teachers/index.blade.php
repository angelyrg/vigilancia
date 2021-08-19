@extends('layouts.adminlte')

@section('content')
<div class="container-fluid">

    @if (Session::has('messageNoHorario') )
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
            {{ Session::get("messageNoHorario")}}
        </div>
    @endif

    <h3>Gestión de registros de docentes</h3>
    <hr>
    <div class="container-fluid row text-right">        
        <a href="/teachers/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombres y Apellidos</th>
                            <th>DNI</th>
                            <th>Fecha de ingreso</th>
                            @if (Auth::user()->role_id == 1)
                                <th>Registrado por</th>
                            @endif
                            <th>Fecha de salida</th>
                            <th>Observación</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{$teacher->id}}</td>
                                <td>{{$teacher->nombres." ".$teacher->apellidos}}</td>
                                <td>{{$teacher->dni}}</td>
                                <td>{{$teacher->created_at->format('d/m/Y h:i A')}}</td>

                                @if (Auth::user()->role_id == 1)
                                    <td>{{$users->find($teacher->login_id)->name}}</td>
                                @endif

                                @if ($teacher->estado == 0)
                                    <td><span class="label label-warning">Pendiente</span></td>                                    
                                @else                                    
                                    <td>{{date('d/m/Y h:i A', strtotime($teacher->leave_at))}}</td>
                                @endif

                                <td>
                                    @if ($teacher->descripcion != null)
                                        {{$teacher->descripcion}}
                                    @else
                                        <span class="label label-primary"><i class="fa fa-check-square-o"></i> Ninguna</span>
                                        
                                    @endif
                                </td>


                                
                                <td>
                                    @if ($teacher->estado == 0)
                                        <a href="/teachers/{{$teacher->id}}/marcarSalida" class="btn btn-info btn-sm">Marcar salida</a>                                  
                                    @else
                                        <span class="label label-success">Salió</span>                                          
                                    @endif
                                </td>
                                <td><a href="/teachers/{{$teacher->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/teachers/{{$teacher->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $teachers->render() !!}
            </ul>
        </div>



</div>
@endsection