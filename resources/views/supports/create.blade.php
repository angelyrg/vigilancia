@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar salida apoyo</h3>
            </div>
            <form method="POST" action="/supports" aria-label="{{ __('Nuevo registro') }}">
                @csrf
                @method('POST')
                
                <div class="box-body">

                    <div class="form-group {{$errors->has('vigilante_id') ? ' has-error' : ''}}">
                        <label for="vigilante_id" >{{ __('Vigilante') }}</label>

                        <div >
                            <select id="vigilante_id" name="vigilante_id"  class="form-control" required >
                                <option value="">-Seleccione-</option>
                                @foreach ($vigilantes as $vigilante)
                                    <option value="{{$vigilante->id}}" >{{$vigilante->name." ".$vigilante->lastname}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('vigilante_id'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('vigilante_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('oficina') ? ' has-error' : ''}}">
                        <label for="oficina" >{{ __('Oficina') }}</label>

                        <div >
                            <input id="oficina" type="text" class="form-control" name="oficina" value="{{ old('oficina') }}" required maxlength="100">

                            @if ($errors->has('oficina'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('oficina') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('documento') ? ' has-error' : ''}}">
                        <label for="documento" >{{ __('Documento') }}</label>

                        <div >
                            <input id="documento" type="text" class="form-control" name="documento" value="{{ old('documento') }}" required >

                            @if ($errors->has('documento'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('documento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('destino') ? ' has-error' : ''}}">
                        <label for="destino" >{{ __('Destino') }}</label>

                        <div >
                            <input id="destino" type="text" class="form-control" name="destino" value="{{ old('destino') }}" required>

                            @if ($errors->has('destino'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('destino') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                     
                
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <div class="col text-right">
                            <a href="/supports" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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