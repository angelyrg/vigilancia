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

    <h3>Gestión de registros de Préstamos</h3>
    <hr>
    <div class="container row text-right">        
        <a href="/borrowings/create" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Nuevo</a>
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
                            <th>Fecha de préstamo</th>
                            @if (Auth::user()->role_id == 1)
                                <th>Registrado por</th>
                            @endif
                            <th>Descripción</th>
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
                               
                                <td>{{$borrowing->created_at->format('d/m/Y h:i A')}}</td>
                                @if (Auth::user()->role_id == 1)
                                    <td>{{$users->find($borrowing->login_id)->name}}</td>
                                @endif
                                <td>{{$borrowing->descripcion}}</td>
                                <td>
                                    @if ($borrowing->estado == 0)
                                        <span class="label label-warning"><i class="fa fa-clock-o"></i> Pendiente</span>                                  
                                    @else
                                        {{date('d/m/Y h:i A', strtotime($borrowing->fecha_devolucion ))}}                                         
                                    @endif
                                </td>

                                <td>
                                    @if ($borrowing->estado == 0)
                                        <a href="/borrowings/{{$borrowing->id}}/devolucion" class="btn btn-info btn-sm">Marcar devolución</a>                                  
                                    @else
                                        <span class="label label-success">Devuelto</span>                                          
                                    @endif
                                </td>

                                <td><a href="/borrowings/{{$borrowing->id}}/edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a></td>
                                <td><a href="/borrowings/{{$borrowing->id}}/confirmDelete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>                    
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