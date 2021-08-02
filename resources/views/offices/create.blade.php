@extends('layouts.adminlte')

@section('content')
<div class="container">
    <div class="container  col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar nueva oficina</h3>
            </div>
            
            <form method="POST" action="/offices" aria-label="{{ __('Nueva oficina') }}">
                @csrf
                @method('POST')

                <div class="box-body">

                    <div class="form-group {{$errors->has('nombre_oficina') ? ' has-error' : ''}}">
                        <label for="nombre_oficina" >{{ __('Oficina') }}</label>

                        <div >
                            <input id="nombre_oficina" type="text" class="form-control" name="nombre_oficina" value="{{ old('nombre_bien') }}" required autofocus placeholder="Nombre del bien">

                            @if ($errors->has('nombre_oficina'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre_oficina') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                </div>
                
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col text-right">
                            <a href="/offices" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{ __('Guardar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection


