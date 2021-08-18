@extends('layouts.adminlte')

@section('content')
<div class="container">

    {{-- <h3>Editar usuario</h3>
    <hr> --}}
    <div class="container">

        <div class="col-md-6 col-md-offset-3">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Editar datos del usuario</h3>
                </div>
    
                <div class="box-body">
                    <form method="POST" action="/user/{{$user->id}}" aria-label="{{ __('Editar usuario') }}">
                        @csrf
                        @method('put')

                        <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="@if(!old('name')){{$user->name}}@else{{old('name')}}@endif" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="@if(!old('lastname')){{$user->lastname}}@else{{old('lastname')}}@endif" required >

                                @if ($errors->has('lastname'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('dni') ? ' has-error' : '' }}">
                            <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                            <div class="col-md-6">
                                <input id="dni" type="text" class="form-control" name="dni" value="@if(!old('dni')){{$user->dni}}@else{{old('dni')}}@endif" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

                                @if ($errors->has('dni'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="@if(!old('phone')){{$user->phone}}@else{{old('phone')}}@endif" required maxlength="9" pattern="[0-9]{9}" title="Ingrese un número de celular correcto">

                                @if ($errors->has('phone'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row {{ $errors->has('contract_start') ? ' has-error' : '' }}">
                            
                            <label for="contract_start" class="col-md-4 col-form-label text-md-right" >{{ __('Inicio de Contrato') }}</label>
    
                            <div class="col-md-6">
                                <input id="contract_start" type="date" class="form-control" name="contract_start" value="@if(!old('contract_start')){{$user->contract_start}}@else{{old('contract_start')}}@endif" required >
    
                                @if ($errors->has('contract_start'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('contract_start') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('contract_end') ? ' has-error' : '' }}">
                            
                            <label for="contract_end" class="col-md-4 col-form-label text-md-right" >{{ __('Inicio de Contrato') }}</label>
    
                            <div class="col-md-6">
                                <input id="contract_end" type="date" class="form-control" name="contract_end" value="@if(!old('contract_end')){{$user->contract_end}}@else{{old('contract_end')}}@endif" required >
    
                                @if ($errors->has('contract_end'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('contract_end') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row {{ $errors->has('role_id') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                            <div class="col-md-6">


                                <select name="role_id" id="role_id" class="form-control" required>
                                    
                                    @foreach ($roles as $rol)

                                        @if ($user->role->id  == $rol->id))
                                            <option value="{{$rol->id}}" selected>{{$rol->description}}</option>
                                        @else
                                            <option value="{{$rol->id}}">{{$rol->description}}</option>
                                        @endif

                                    @endforeach
                                </select>

                                

                                @if ($errors->has('role_id'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row {{ $errors->has('active') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                            <div class="col-md-6">


                                <select name="active" id="active" class="form-control" required>
                                    @if ($user->active == 1)
                                        <option value="1" selected>Activo</option>
                                        <option value="0">Desactivado</option>                                        
                                    @else
                                        <option value="1">Activo</option>
                                        <option value="0" selected>Desactivado</option>                                        
                                    @endif
                                </select>

                                

                                @if ($errors->has('active'))
                                    <span class="help-block" role="alert">
                                        <strong>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        


                        <div class="form-group">
                            <div class="col text-right">
                                <a href="/user" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection