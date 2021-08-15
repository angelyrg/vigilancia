@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Eliminar turno</h3>
    <hr>

    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="/horario/{{$horario->id}}" >
            @csrf
            @method('delete')
            <div class="panel panel-danger">

                <div class="panel-heading"><h5><b>Confirmar eliminar horario</b></h5></div>

                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3 class="text-center">¿Estás seguro de eliminar el turno de {{$vigilante->name." ".$vigilante->lastname}}?</h3>                                
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-right">
                    <a href="/horario" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        {{ __('Eliminar') }}
                    </button>
                </div>    
                                
        </form>
    </div>



</div>
@endsection