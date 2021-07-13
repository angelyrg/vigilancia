@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro</h3>
            </div>
            <form method="POST" action="/visitors/{{$visitor->id}}" aria-label="{{ __('Editar registro') }}">
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group ">
                        <label for="nombres" >{{ __('Nombres') }}</label>

                        <div >
                            <input id="nombres" type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="@if(!old('nombres')){{$visitor->nombres}}@else{{old('nombres')}}@endif" required autofocus>

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
                            <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="@if(!old('apellidos')){{$visitor->apellidos}}@else{{old('apellidos')}}@endif" required >

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
                            <input id="dni" type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="@if(!old('dni')){{$visitor->dni}}@else{{old('dni')}}@endif" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

                            @if ($errors->has('dni'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('dni') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="motivo" >{{ __('Motivo de visita') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control{{ $errors->has('motivo') ? ' is-invalid' : '' }}" name="motivo" required>@if(!old('motivo')){{$visitor->motivo}}@else{{old('motivo')}}@endif</textarea>
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
                            <a href="/visitors" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection