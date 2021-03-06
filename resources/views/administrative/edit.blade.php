@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro</h3>
            </div>
            <form method="POST" action="/administrative/{{$administrative->id}}" aria-label="{{ __('Editar registro') }}">
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group {{ $errors->has('nombres') ? 'has-error' : '' }}">
                        <label for="nombres" >{{ __('Nombres') }}</label>

                        <div >
                            <input id="nombres" type="text" class="form-control" name="nombres" value="@if(!old('nombres')){{$administrative->nombres}}@else{{old('nombres')}}@endif" required autofocus>

                            @if ($errors->has('nombres'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('nombres') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('apellidos') ? 'has-error' : '' }}">
                        <label for="apellidos" >{{ __('Apellidos') }}</label>

                        <div >
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="@if(!old('apellidos')){{$administrative->apellidos}}@else{{old('apellidos')}}@endif" required >

                            @if ($errors->has('apellidos'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
                        <label for="dni" >{{ __('DNI') }}</label>

                        <div >
                            <input id="dni" type="text" class="form-control" name="dni" value="@if(!old('dni')){{$administrative->dni}}@else{{old('dni')}}@endif" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un n??mero de DNI correcto">

                            @if ($errors->has('dni'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('dni') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('descripcion') ? 'has-error' : '' }}">
                        <label for="descripcion" >{{ __('Observaci??n') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control" name="descripcion">@if(!old('descripcion')){{$administrative->descripcion}}@else{{old('descripcion')}}@endif</textarea>
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
                            <a href="/administrative" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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