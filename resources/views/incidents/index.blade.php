@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de registros de Incidentes</h3>
    <hr>
    <div class="container row text-right">        
        <a href="/incidents/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha de registro</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($incidents as $incident)
                            <tr>
                                <td>{{$incident->nombre_incidente}}</td>
                                <td>{{$incident->descripcion}}</td>
                                <td>{{$incident->created_at->format('d/m/Y h:i A')}}</td>

                                <td><a href="/incidents/{{$incident->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/incidents/{{$incident->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $incidents->render() !!}
            </ul>
        </div>



</div>
@endsection