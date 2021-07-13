@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Eliminar turno</h3>
    <hr>


    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="/user/{{$horario->id}}" aria-label="{{ __('Confirmar eliminar horario') }}">
            <div class="panel panel-danger">
                <div class="panel-heading"><h5><b>Confirmar eliminar</b></h5></div>

                <div class="panel-body">
                    @csrf
                    @method('delete')

                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3 class="text-center">¿Estás seguro de eliminar el turno?</h3>                                
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-right">
                    <a href="/horario" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-remove"></i>
                        {{ __('Eliminar') }}
                    </button>
                </div>    
                                
        </form>
    </div>



</div>
@endsection