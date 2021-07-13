@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar administrataivo</h3>
            </div>
            <form method="POST" action="/administrative" aria-label="{{ __('Nuevo registro') }}">
                @csrf
                @method('POST')
                
                <div class="box-body">

                    <div class="form-group ">
                        <label for="nombres" >{{ __('Nombres') }}</label>

                        <div >
                            <input id="nombres" type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="{{ old('nombres') }}" required autofocus>

                            @if ($errors->has('nombres'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombres') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="apellidos" >{{ __('Apellidos') }}</label>

                        <div >
                            <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ old('apellidos') }}" required >

                            @if ($errors->has('apellidos'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="dni" >{{ __('DNI') }}</label>

                        <div >
                            <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('dni') }}" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

                            @if ($errors->has('dni'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dni') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="descripcion" >{{ __('Descripción') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" required> {{ old('descripcion') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                      
                
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar') }}
                            </button>
                            <a href="/administrative" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection