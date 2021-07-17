@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Eliminar registro</h3>
    <hr>
    <div class="container">

        <div class="col-md-8 col-md-offset-2">
            <form method="POST" action="/incidents/{{$incident->id}}" aria-label="{{ __('Confirmar eliminar registro de incidente') }}">
                @csrf
                @method('delete')

                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{ __('Confirmar eliminar registro') }}</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h3 class="text-center">¿Estás seguro de eliminar el registro?</h3>
                            </div>
                        </div>                        
                    </div>
                    <div class="box-footer">
                        <div class="form-group text-right">
                            <div class="col ">
                                <a href="/incidents" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> {{ __('Eliminar') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection