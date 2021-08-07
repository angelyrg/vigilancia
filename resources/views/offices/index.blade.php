@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de Oficinas</h3>
    <hr>

    <div class="container row text-right">
        @if (Auth::user()->role_id == '1')
            <a href="/offices/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
        @endif
    </div>

    <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Oficinas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="">
                            <th class="">ID</th>
                            <th class="">Oficina</th>
                            <th colspan="2" class="">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices as $office)
                        <tr>
                            <td>{{ $office->id}}</td>
                            <td>{{ $office->nombre_oficina}}</td>
                            {{-- <td><a href="/offices/{{$office->id}}/edit" class="btn btn-warning">Editar</a></td> --}}
                            <td>
                                @if (Auth::user()->role_id == '1')                                    
                                    <a href="/offices/{{$office->id}}/confirmDelete" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="/offices/{{$office->id}}/historialOficinas" class="btn btn-success"><i class="fa fa-list"></i> Historial</a>
                            </td>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $offices->render() !!}
            </ul>
        </div>
    </div>





    

    



</div>
@endsection