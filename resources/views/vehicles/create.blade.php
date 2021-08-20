@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar vehículo</h3>

            </div>

            <div class="row col container-fluid">               

                <div class="container-fluid input-group">
                    <input type="text" class="form-control" id="dni_search" name="dni_search" placeholder="Buscar conductor del vehículo por DNI" maxlength="8" autofocus>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success " id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                    </span>
                </div>

                
                <div class="col container-fluid">
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw" style="color: rgb(1, 72, 163); display: none;" id="icono_cargando" ></i>
                    <small id="mensaje" style="color: red;display: none;font-size: 12pt;" > 
                        <i class="fa fa-remove"></i> No se encontró el número de DNI del conductor. 
                    </small>
                </div>                            
            </div>


            <form method="POST" action="/vehicles" aria-label="{{ __('Nuevo registro') }}">
                @csrf
                @method('POST')
                
                <div class="box-body">

                    <div class="form-group {{$errors->has('apellidos') ? ' has-error' : ''}}">
                        <label for="apellidos" >{{ __('Apellidos del conductor') }}</label>

                        <div >
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required >

                            @if ($errors->has('apellidos'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        
                        <div class=" col-md-6">

                            <div class="form-group {{$errors->has('nombres') ? ' has-error' : ''}}">
                                <label for="nombres" >{{ __('Nombres del conductor') }}</label>
        
                                <div >
                                    <input id="nombres" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" required  >
        
                                    @if ($errors->has('nombres'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('nombres') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-md-6">

                            <div class="form-group {{$errors->has('dni_conductor') ? ' has-error' : ''}}">
                                <label for="dni" >{{ __('DNI') }}</label>
        
                                <div >
                                    <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">
        
                                    @if ($errors->has('dni_conductor'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('dni_conductor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="text-center">
                            <small>Detalles del vehículo</small>
                        </div>
                    </div>

                    <div class="row">

                        <div class=" col-md-6">
                            <div class="form-group {{$errors->has('placa') ? ' has-error' : ''}}">
                                <label for="placa" >{{ __('Placa ') }}</label>        
                                <div >
                                    <input id="placa" type="text" class="form-control" name="placa" value="{{ old('placa') }}" required autofocus maxlength="7" >
        
                                    @if ($errors->has('placa'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('placa') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                            
                        </div>

                        <div class="col-md-6">
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
                        </div>

                    </div>

                    <div class="row">                      

                        <div class=" col-md-6">
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

                        </div>
                        <div class="col-md-6">
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


{{-- Incluimos el api de la reniec --}}
<script src="{{ asset("js/reniec.js") }}"></script>



@endsection