@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Gestión de registros de Préstamos</h3>
    <hr>
    <div class="row">        
        <a href="/borrowings/create" class="btn btn-primary">Nuevo</a>
    </div>

    <div class="box">
        <div class="box-body">
            <div class="table-responsive">
                <table class="table table-hover" >
                    <thead class="thead-dark">
                        <tr>
                            <th>Bien</th>
                            <th>Cantidad</th>
                            <th>Nombre encargado</th>
                            {{-- <th>DNI</th> --}}
                            <th>Descripción</th>
                            <th>Fecha de registro</th>
                            <th>Fecha de devolución</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowings as $borrowing)
                            <tr>
                                <td>{{$borrowing->nombre_bien}}</td>
                                <td>{{$borrowing->cantidad}}</td>
                                <td>{{$borrowing->nombre_encargado}}</td>
                                {{-- <td>{{$borrowing->dni}}</td> --}}
                                <td>{{$borrowing->descripcion}}</td>
                                <td>{{$borrowing->created_at}}</td>
                                <td>{{$borrowing->fecha_devolucion}}</td>
                                <td>
                                    @if ($borrowing->estado == 0)
                                        <a href="/borrowings/{{$borrowing->id}}/devolucion" class="btn btn-info btn-sm">Marcar devolución</a>                                  
                                    @else
                                        <span class="label label-success">Devuelto</span>                                          
                                    @endif
                                </td>

                                <td><a href="/borrowings/{{$borrowing->id}}/edit" class="btn btn-warning btn-sm">Editar</a></td>
                                <td><a href="/borrowings/{{$borrowing->id}}/confirmDelete" class="btn btn-danger btn-sm">Eliminar</a></td>                    
                            </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </div>

        <!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                {!! $borrowings->render() !!}
            </ul>
        </div>



</div>
@endsection