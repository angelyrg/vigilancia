@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de usuarios</h3>
    <hr>
    <div class="row">        
        <a href="/user/create" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Usuarios registrados</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>DNI</th>
                            <th>Celular</th>
                            {{-- <th>Correo</th> --}}
                            <th>Rol</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->dni}}</td>
                                <td>{{$user->phone}}</td>
                                {{-- <td>{{$user->email}}</td> --}}
                                <td>{{$user->role->description}}</td>
                                <td><a href="/user/{{$user->id}}/edit" class="btn btn-warning btn-sm">Editar</a></td>
                                <td><a href="/user/{{$user->id}}/confirmDelete" class="btn btn-danger btn-sm">Eliminar</a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $users->render() !!}
            </ul>
        </div>



</div>
@endsection