@extends('layouts.adminlte')

@section('content')
<div class="container">

    
    <h3>Gestión de Horarios</h3>
    <hr>
        @if (Session::has('message') )
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> !</h4>
                {{ Session::get("message")}}
            </div>
        @endif
    <div class="box">
        <div class="box-header"><h3 class="box-title">Horarios</h3> </div>
        <div class="box-body">
            <div class="table table-responsive">

                <table class="table">
                    <thead class="bg-light-blue  color-palette">
                        <tr>
                            <th>Días</th>
                            <th>Turno día <span class="label label-primary">(6:00 AM - 6:00 PM)</span></th>
                            <th>Turno noche <span class="label label-primary">(6:00 PM - 6:00 AM día siguiente)</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $contador = 1; @endphp

                        @foreach ($dias as $dia)

                            <tr>
                                <td>{{$dia}}</td>

                                <td>
                                    @foreach ($horarios as $item)
                                        @if ($item->turno == $contador)
                                            @foreach ($vigilantes as $vigilante)
                                                @if ($vigilante->id == $item->user_id)
                                                    <a href="/horario/{{$item->id}}/confirmDelete" class="btn bg-maroon btn-sm ">
                                                        {{$vigilante->name." ".$vigilante->lastname}} <i class="fa fa-remove"></i>
                                                    </a>                                                    
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-add{{$contador}}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </td>

                                <div class="modal fade" id="modal-add{{$contador}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/horario" method="post">
                                                @csrf

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Asignar vigilante a este turno </h4>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="user_id">Seleccione vigilante</label>
                                                        <select name="user_id" id="user_id" class="form-control" required>
                                                            @foreach ($vigilantes as $vigilante)
                                                                <option value="{{$vigilante->id}}" >{{$vigilante->name." ".$vigilante->lastname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="turno" value="{{$contador}}">
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                @php $contador++; @endphp


                                <td>
                                    @foreach ($horarios as $item)
                                        @if ($item->turno == $contador)
                                            @foreach ($vigilantes as $vigilante)
                                                @if ($vigilante->id == $item->user_id)
                                                    <a href="/horario/{{$item->id}}/confirmDelete" class="btn bg-purple btn-sm ">
                                                        {{$vigilante->name." ".$vigilante->lastname}} <i class="fa fa-remove"></i>
                                                    </a>                                                    
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    
                                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-add{{$contador}}">
                                        <i class="fa fa-plus"></i>                                        
                                    </button>
                                </td>

                                <div class="modal fade" id="modal-add{{$contador}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="/horario" method="post">
                                                @csrf

                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Asignar vigilante a este turno </h4>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="user_id">Seleccione vigilante</label>
                                                        <select name="user_id" id="user_id" class="form-control" required>
                                                            @foreach ($vigilantes as $vigilante)
                                                                <option value="{{$vigilante->id}}" >{{$vigilante->name." ".$vigilante->lastname}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input type="hidden" name="turno" value="{{$contador}}">
                                                    </div>
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar</button>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                @php $contador++; @endphp
                            </tr>
                            

                        @endforeach


                        

                    </tbody>
                </table>

            </div>

        </div>
        <div class="box-footer">
            ...
        </div>
    </div>





</div>
@endsection



