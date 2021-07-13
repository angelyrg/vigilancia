@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Eliminar registro</h3>
    <hr>
    <div class="container">

        <div class="col-md-8 offset-md-2">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Confirmar eliminar registro') }}</h3>
                </div>

                <div class="box-body">
                    <form method="POST" action="/borrowings/{{$borrowing->id}}" aria-label="{{ __('Confirmar eliminar registro de préstamo') }}">
                        @csrf
                        @method('delete')

                        <div class="form-group row">

                            <div class="col-md-12">
                                <h3 class="text-center">¿Estás seguro de eliminar el registro?</h3>
                            </div>
                        </div>
                       

                        <div class="form-group row mb-0 text-right">
                            <div class="col-md-6 col-md-offset-4 ">
                                <a href="/borrowings" class="btn btn-default">Cancelar</a>
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Eliminar') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection