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

                    <div class="form-group {{$errors->has('nombres') ? ' has-error' : ''}}">
                        <label for="nombres" >{{ __('Nombres') }}</label>

                        <div >
                            <input id="nombres" type="text" class="form-control" name="nombres" value="@if(!old('nombres')){{$visitor->nombres}}@else{{old('nombres')}}@endif" required autofocus>

                            @if ($errors->has('nombres'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('nombres') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('apellidos') ? ' has-error' : ''}}">
                        <label for="apellidos" >{{ __('Apellidos') }}</label>

                        <div >
                            <input id="apellidos" type="text" class="form-control" name="apellidos" value="@if(!old('apellidos')){{$visitor->apellidos}}@else{{old('apellidos')}}@endif" required >

                            @if ($errors->has('apellidos'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('dni') ? ' has-error' : ''}}">
                        <label for="dni" >{{ __('DNI') }}</label>

                        <div >
                            <input id="dni" type="text" class="form-control" name="dni" value="@if(!old('dni')){{$visitor->dni}}@else{{old('dni')}}@endif" required maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

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
                                @foreach ($offices as $office)
                                    @if ($office->id == $visitor->oficina_id)                                        
                                        <option value="{{$office->id}}" {{ old('oficina_id') == $office->id ? 'selected' : ''}} selected>{{$office->nombre_oficina}}</option>
                                    @else
                                        <option value="{{$office->id}}" {{ old('oficina_id') == $office->id ? 'selected' : ''}} >{{$office->nombre_oficina}}</option>
                                    @endif
                                @endforeach
                            </select>

                            @if ($errors->has('oficina_id'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('oficina_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>    


                    <div class="form-group {{$errors->has('motivo') ? ' has-error' : ''}}">
                        <label for="motivo" >{{ __('Motivo de visita') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control" name="motivo" required>@if(!old('motivo')){{$visitor->motivo}}@else{{old('motivo')}}@endif</textarea>
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


@endsection