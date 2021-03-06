@extends('layouts.adminlte')

@section('content')

<section class="content-header">
    <h1>
        Gestión de usuarios
        <small>Registrar nuevo usuario</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="/user">Usuarios</a></li>
        <li class="active">Nuevo</li>
    </ol>
</section>

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar nuevo usuario</h3>
            </div>

            <div class="row col container-fluid">
                

                <div class="container-fluid input-group">

                    <input type="text" class="form-control" id="dni_search" name="dni_search" placeholder="Buscar DNI" maxlength="8" autofocus>
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
                <form method="POST" action="/user" aria-label="{{ __('Nuevo usuario') }}">
                    @csrf
                    @method('POST')
                    
                    <div class="box-body">
    
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="nombres" >{{ __('Nombres') }}</label>
    
                            <div >
                                <input id="nombres" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
    
                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="apellidos" >{{ __('Apellidos') }}</label>
    
                            <div >
                                <input id="apellidos" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required >
    
                                @if ($errors->has('lastname'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class=" col-md-6">
    
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
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" >{{ __('Celular') }}</label>
            
                                    <div >
                                        <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required maxlength="9" pattern="[0-9]{9}" title="Ingrese un número de celular correcto">
            
                                        @if ($errors->has('phone'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
    
                            </div>
                        </div>


                        <div class="row">
                            <div class=" col-md-6">
    
                                <div class="form-group {{ $errors->has('contract_start') ? ' has-error' : '' }}">
                                    
                                    <label for="contract_start" >{{ __('Inicio de Contrato') }}</label>
            
                                    <div >
                                        <input id="contract_start" type="date" class="form-control" name="contract_start" value="{{ old('contract_start') }}" required >
            
                                        @if ($errors->has('contract_start'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('contract_start') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('contract_end') ? ' has-error' : '' }}">
                                    <label for="contract_end" >{{ __('Fin del contrato') }}</label>
            
                                    <div >
                                        <input id="contract_end" type="date" class="form-control" name="contract_end" value="{{ old('contract_end') }}" required >
            
                                        @if ($errors->has('contract_end'))
                                            <span class="help-block" role="alert">
                                                <strong>{{ $errors->first('contract_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
    
                            </div>
                        </div>

    
                        <div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="phone" >{{ __('Rol') }}</label>
    
                            <div >
                                <select name="role_id" id="role_id" class="form-control" required> 
                                    <option value="2">Vigilante</option>
                                    <option value="1">Administrador</option>
                                </select>
    
                                @if ($errors->has('role_id'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        
                    
                    </div>
    
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col text-right">
                                <a href="/user" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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