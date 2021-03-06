@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar visitante</h3>
            </div>

            <br>

            <div class="row col container-fluid">

                <div class="container-fluid input-group">

                    <input type="text" class="form-control" id="dni_search" name="dni_search" placeholder="Buscar visitante por DNI" maxlength="8" autofocus>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success " id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                    </span>
                </div>

                
                <div class="col container-fluid">
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw" style="color: rgb(194, 0, 0); display: none;" id="icono_cargando" ></i>
                    <small id="mensaje" style="color: red;display: none;font-size: 12pt;" > 
                        <i class="fa fa-remove"></i> No se encontró el número de DNI. 
                    </small>
                </div>                            
            </div>

            
            <div class="row container-fluid ">
                <br>
                <form method="POST" action="/visitors" >
                    @csrf
                    @method('POST')
                    
                    <div class="box-body">
    
                        <div class="form-group {{$errors->has('nombres') ? ' has-error' : ''}}">
                            <label for="nombres" >{{ __('Nombres') }}</label>
    
                            <div >
                                <input id="nombres" type="text" class="form-control" name="nombres" value="{{ old('nombres') }}" required autofocus>
    
                                @if ($errors->has('nombres'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group {{ $errors->has('apellidos') ? ' has-error' : '' }}">
                            <label for="apellidos" >{{ __('Apellidos') }}</label>
    
                            <div >
                                <input id="apellidos" type="text" class="form-control" name="apellidos" value="{{ old('apellidos') }}" required >
    
                                @if ($errors->has('apellidos'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('apellidos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group {{ $errors->has('dni') ? ' has-error' : '' }}">
                            <label for="dni" >{{ __('DNI') }}</label>
    
                            <div >
                                <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">
    
                                @if ($errors->has('dni'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('oficina_id') ? ' has-error' : ''}}">
                            <label for="oficina_id" >{{ __('Oficina al que visita') }}</label>
    
                            <div >
                                <select id="oficina_id" name="oficina_id"  class="form-control" required >
                                    <option value="">-Seleccione-</option>
                                    @foreach ($offices as $office)
                                        <option value="{{$office->id}}" {{ old('oficina_id') == $office->id ? 'selected' : ''}}>{{$office->nombre_oficina}}</option>
                                    @endforeach
                                </select>
    
                                @if ($errors->has('oficina_id'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('oficina_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    
    
                        <div class="form-group {{ $errors->has('motivo') ? ' has-error' : '' }}">
                            <label for="motivo" >{{ __('Motivo de Visita') }}</label>
    
                            <div >
                                <textarea cols="30" rows="4" class="form-control" name="motivo"  id="descripcion" required> {{ old('motivo') }}</textarea>
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
                                <a href="/visitors" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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

    {{-- Incluimos el api de la reniec --}}
    <script src="{{ asset("js/reniec.js") }}"></script>

@endsection

