@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar vehículo</h3>
            </div>
            <form method="POST" action="/vehicles" aria-label="{{ __('Nuevo registro') }}">
                @csrf
                @method('POST')
                
                <div class="box-body">

                    <div class="form-group {{$errors->has('placa') ? ' has-error' : ''}}">
                        <label for="placa" >{{ __('Placa') }}</label>

                        <div >
                            <input id="placa" type="text" class="form-control" name="placa" value="{{ old('placa') }}" required autofocus maxlength="7" >

                            @if ($errors->has('placa'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('placa') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('conductor') ? ' has-error' : ''}}">
                        <label for="conductor" >{{ __('Conductor') }}</label>

                        <div >
                            <input id="conductor" type="text" class="form-control" name="conductor" value="{{ old('conductor') }}" required maxlength="150">

                            @if ($errors->has('conductor'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('conductor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('dni_conductor') ? ' has-error' : ''}}">
                        <label for="dni_conductor" >{{ __('DNI') }}</label>

                        <div >
                            <input id="dni_conductor" type="text" class="form-control" name="dni_conductor" value="{{ old('dni_conductor') }}" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

                            @if ($errors->has('dni_conductor'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('dni_conductor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('tipo_vehiculo') ? ' has-error' : ''}}">
                        <label for="tipo_vehiculo" >{{ __('Tipo del vehículo') }}</label>
                        <div >
                            <input id="tipo_vehiculo" type="text" class="form-control" name="tipo_vehiculo" value="{{ old('tipo_vehiculo') }}" required maxlength="50">
                            @if ($errors->has('tipo_vehiculo'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('tipo_vehiculo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('color') ? ' has-error' : ''}}">
                        <label for="color" >{{ __('Color') }}</label>
                        <div >
                            <input id="color" type="text" class="form-control" name="color" value="{{ old('color') }}" required maxlength="25">
                            @if ($errors->has('color'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('propiedad_epis') ? ' has-error' : '' }}">
                        <label for="propiedad_epis" >Propietario</label>

                        <div >
                            <select name="propiedad_epis" id="propiedad_epis" class="form-control" required> 
                                <option value="1">Propiedad de EPIS</option>
                                <option value="0">Externo</option>
                            </select>

                            @if ($errors->has('propiedad_epis'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('propiedad_epis') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                        


                    <div class="form-group {{$errors->has('motivo') ? ' has-error' : ''}}">
                        <label for="motivo" >{{ __('Motivo de Visita') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control" name="motivo" required> {{ old('motivo') }}</textarea>
                            @if ($errors->has('motivo'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('motivo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                      
                
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <div class="col text-right">
                            <a href="/vehicles" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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