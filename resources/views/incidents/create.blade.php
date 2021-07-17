@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar incidente</h3>
            </div>
            <form method="POST" action="/incidents" aria-label="{{ __('Nuevo incidente') }}">
                @csrf
                @method('POST')
                
                <div class="box-body">

                    <div class="form-group {{$errors->has('nombre_incidente') ? ' has-error' : ''}}">
                        <label for="nombre_incidente" >{{ __('Incidente') }}</label>

                        <div >
                            <input id="nombre_incidente" type="text" class="form-control{{ $errors->has('nombre_incidente') ? ' is-invalid' : '' }}" name="nombre_incidente" value="{{ old('nombre_incidente') }}" required autofocus maxlength="50">

                            @if ($errors->has('nombre_incidente'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('nombre_incidente') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group {{$errors->has('descripcion') ? ' has-error' : ''}}">
                        <label for="descripcion" >{{ __('Descripción') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" required> {{ old('descripcion') }}</textarea>
                            @if ($errors->has('descripcion'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                      
                
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <div class="col text-right">
                            <a href="/incidents" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> {{ __('Guardar') }}
                            </button>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection