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



    <h3>Gestión de registros de apoyo</h3>
    <hr>
    <div class="container-fluid row text-right">        
        <a href="/supports/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>

    <div class="box">

        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Vigilante</th>
                            <th>Oficina</th>
                            <th>Documento</th>
                            <th>Destino</th>
                            <th>Fecha de registro</th>
                            @if (Auth::user()->role_id == 1)
                                <th>Registrado por</th>
                            @endif
                            <th>Retorno</th>

                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supports as $support)
                            <tr>
                                <td>{{$support->vigilante->name." ".$support->vigilante->lastname}}</td>
                                <td>{{$support->oficina}}</td>
                                <td>{{$support->documento}}</td>
                                <td>{{$support->destino}}</td>
                                <td>{{$support->created_at->format('d/m/Y h:i A')}}</td>
                                @if (Auth::user()->role_id == 1)
                                    <td>{{$users->find($support->login_id)->name}}</td>
                                @endif
                                <td>
                                    @if ($support->estado == 0)
                                        <span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span>                                  
                                    @else
                                        {{ date('d/m/Y h:i A', strtotime($support->fecha_retorno))}}                                         
                                    @endif
                                </td>

                                <td>
                                    @if ($support->estado == 0)
                                        <a href="/supports/{{$support->id}}/retorno" class="btn btn-info btn-sm">Marcar retorno</a>                                  
                                    @else
                                        <span class="label label-success">Retornó</span>                                          
                                    @endif
                                </td>
                                <td><a href="/supports/{{$support->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/supports/{{$support->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $supports->render() !!}
            </ul>
        </div>



</div>
@endsection