@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de Horarios</h3>
    <div class="row">        
        <a href="/horario/create" class="btn btn-primary">Nuevo</a>
    </div>
    <hr>



    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Horarios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th class="text-center">Vigilante</th>
                            <th colspan="2" class="text-center">Inicio</th>
                            <th colspan="2" class="text-center">Finalización</th>
                            <th colspan="2" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($horarios as $horario)
                        <tr>
                            <td>{{ $vigilantes->find($horario->user_id)->name." ".$vigilantes->find($horario->user_id)->lastname }}</td>
                            <td>{{ $dias[$horario->dia_semana_inicio] }}</td>
                            <td>{{ date("g:i a",strtotime($horario->hora_inicio)) }}</td>
                            <td>{{ $dias[$horario->dia_semana_fin] }}</td>
                            <td>{{ date("g:i a",strtotime($horario->hora_final)) }}</td>
                            <td></td>
                            {{-- <td><a href="/horario/{{$horario->id}}/edit" class="btn btn-warning">Editar</a></td> --}}
                            <td><a href="/horario/{{$horario->id}}/confirmDelete" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $horarios->render() !!}
            </ul>
        </div>
    </div>





    

    



</div>
@endsection