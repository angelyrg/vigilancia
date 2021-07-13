@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro</h3>
            </div>
            <form method="POST" action="/vehicles/{{$vehicle->id}}" aria-label="{{ __('Editar registro') }}">
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group ">
                        <label for="placa" >{{ __('Placa') }}</label>

                        <div >
                            <input id="placa" type="text" class="form-control{{ $errors->has('placa') ? ' is-invalid' : '' }}" name="placa" value="@if(!old('placa')){{$vehicle->placa}}@else{{old('placa')}}@endif" required autofocus maxlength="7" >

                            @if ($errors->has('placa'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('placa') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="conductor" >{{ __('Conductor') }}</label>

                        <div >
                            <input id="conductor" type="text" class="form-control{{ $errors->has('conductor') ? ' is-invalid' : '' }}" name="conductor" value="@if(!old('conductor')){{$vehicle->conductor}}@else{{old('conductor')}}@endif" required maxlength="150">

                            @if ($errors->has('conductor'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('conductor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="dni_conductor" >{{ __('DNI') }}</label>

                        <div >
                            <input id="dni_conductor" type="text" class="form-control{{ $errors->has('dni_conductor') ? ' is-invalid' : '' }}" name="dni_conductor" value="@if(!old('dni_conductor')){{$vehicle->dni_conductor}}@else{{old('dni_conductor')}}@endif" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

                            @if ($errors->has('dni_conductor'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dni_conductor') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="tipo_vehiculo" >{{ __('Tipo del vehículo') }}</label>
                        <div >
                            <input id="tipo_vehiculo" type="text" class="form-control{{ $errors->has('tipo_vehiculo') ? ' is-invalid' : '' }}" name="tipo_vehiculo" value="@if(!old('tipo_vehiculo')){{$vehicle->tipo_vehiculo}}@else{{old('tipo_vehiculo')}}@endif" required maxlength="50">
                            @if ($errors->has('tipo_vehiculo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tipo_vehiculo') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="color" >{{ __('Color') }}</label>
                        <div >
                            <input id="color" type="text" class="form-control{{ $errors->has('color') ? ' is-invalid' : '' }}" name="color" value="@if(!old('color')){{$vehicle->color}}@else{{old('color')}}@endif" required maxlength="25">
                            @if ($errors->has('color'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('color') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="motivo" >{{ __('Motivo de Visita') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control{{ $errors->has('motivo') ? ' is-invalid' : '' }}" name="motivo" required>@if(!old('motivo')){{$vehicle->motivo}}@else{{old('motivo')}}@endif</textarea>
                            @if ($errors->has('motivo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('motivo') }}</strong>
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
                            <a href="/vehicles" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection