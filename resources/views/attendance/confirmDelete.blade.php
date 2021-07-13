@extends('layouts.adminlte')

@section('content')
<div class="container">

    <h3>Eliminar usuario</h3>
    <hr>
    <div class="container">

        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">{{ __('Confirmar eliminar usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="/user/{{$user->id}}" aria-label="{{ __('Confirmar eliminar usuario') }}">
                        @csrf
                        @method('delete')

                        <div class="form-group row">

                            <div class="col-md-12">
                                <h3 class="text-center">¿Estás seguro de eliminar el usuario {{$user->name}}?</h3>
                                
                            </div>
                        </div>
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Eliminar') }}
                                </button>
                                <a href="/user" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection