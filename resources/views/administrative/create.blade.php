@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar administrataivo</h3>
            </div>

            <div class="row col container-fluid">
                

                <div class="container-fluid input-group">

                    <input type="text" class="form-control" id="dni_search" name="dni_search" placeholder="Buscar administrativo por DNI" maxlength="8" autofocus>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-success " id="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
                    </span>
                </div>

                
                <div class="col container-fluid">
                    <i class="fa fa-spinner fa-pulse fa-2x fa-fw" style="color: rgb(0, 194, 81); display: none;" id="icono_cargando" ></i>
                    <small id="mensaje" style="color: red;display: none;font-size: 12pt;" > 
                        <i class="fa fa-remove"></i> No se encontró el número de DNI. 
                    </small>
                </div>                            
            </div>
            <br>

            <div class="row container-fluid ">
                <form method="POST" action="/administrative" aria-label="{{ __('Nuevo registro') }}">
                    @csrf
                    @method('POST')
                    
                    <div class="box-body">
    
                        <div class="form-group {{ $errors->has('nombres') ? ' has-error' : '' }}">
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
    
                        <div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
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
    
                        <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                            <label for="descripcion" >{{ __('Observación') }}</label>
    
                            <div >
                                <textarea cols="30" rows="4" class="form-control" name="descripcion" id="descripcion" > {{ old('descripcion') }}</textarea>
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

    </div>

    {{-- Incluimos el api de la reniec --}}
    <script src="{{ asset("js/reniec.js") }}"></script>

@endsection