@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Eliminar oficina</h3>
    <hr>


    <div class="col-md-6 col-md-offset-3">
        <form method="POST" action="/offices/{{$office->id}}" >
            @csrf
            @method('delete')
            <div class="panel panel-danger">

                <div class="panel-heading"><h5><b>Confirmar eliminar oficina</b></h5></div>

                <div class="panel-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <h3 class="text-center">¿Estás seguro de eliminar la oficina?</h3>                                
                        </div>
                    </div>
                </div>

                <div class="panel-footer text-right">
                    <a href="/offices" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                        {{ __('Eliminar') }}
                    </button>
                </div>    
                                
        </form>
    </div>



</div>
@endsection