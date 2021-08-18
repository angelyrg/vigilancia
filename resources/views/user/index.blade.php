@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <h1>
        Gestión de Usuarios
        <small>Listar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Usuarios</li>
    </ol>
</section>
  
<div class="container-fluid">
    <div class="container-fluid row text-right">        
        <a href="/user/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Usuarios registrados</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Celular</th>
                            <th>Inicio Contrato</th>
                            <th>Fin Contrato</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->dni}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    @if ($user->role_id == 1)
                                        <span class="label label-info">No aplica</span>
                                    @else
                                        {{ date('d/m/Y', strtotime($user->contract_start)) }}
                                    @endif                                    
                                </td>
                                <td>
                                    @if ($user->role_id == 1)
                                        <span class="label label-info">No aplica</span>
                                    @else
                                        {{date('d/m/Y', strtotime($user->contract_end )) }}
                                    @endif                                    
                                </td>
                                <td>{{$user->role->description}}</td>
                                <td>
                                    @if ($user->active == 1)
                                        <span class="label label-success">Activo</span>
                                    @else
                                        <span class="label label-danger">Desactivado</span>
                                    @endif
                                </td>
                                <td><a href="/user/{{$user->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/user/{{$user->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <div class="box-footer ">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $users->render() !!}
            </ul>
        </div>



</div>

@endsection 