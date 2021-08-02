@extends('layouts.adminlte')

@section('content')
<div class="container">
    <div class="container  col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Asignar nuevo horario</h3>
            </div>
            
            <form method="POST" action="/horario" aria-label="{{ __('Nuevo horario') }}">
                @csrf
                @method('POST')

                <div class="box-body">

                    <div class="form-group {{ $errors->has('user_id') ? ' has-error' : '' }}">
                        <label for="user_id">{{ __('Vigilante') }}</label>

                        <div class="">
                            <select name="user_id" id="user_id" class="form-control" required> 
                                @foreach ($vigilantes as $vigilante)
                                    <option value="{{$vigilante->id}}">{{$vigilante->name." ".$vigilante->lastname}}</option>
                                @endforeach
                            </select>

                            @if ($errors->has('user_id'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('user_id') }}</strong>
                                </span>
                            @endif
                            
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('dia_semana_inicio') ? ' has-error' : '' }}">
                        <div class="col">
                            <label for="dia_semana_inicio" >{{ __('Inicio del turno') }}</label>
                        </div>

                        <div class="col-md-6">
                            <select name="dia_semana_inicio" id="dia_semana_inicio" class="form-control" required> 
                                <option value="1" {{ old('dia_semana_inicio') == 1 ? 'selected' : ''}}>Lunes</option>
                                <option value="2" {{ old('dia_semana_inicio') == 2 ? 'selected' : ''}}>Martes</option>
                                <option value="3" {{ old('dia_semana_inicio') == 3 ? 'selected' : ''}}>Miércoles</option>
                                <option value="4" {{ old('dia_semana_inicio') == 4 ? 'selected' : ''}}>Jueves</option>
                                <option value="5" {{ old('dia_semana_inicio') == 5 ? 'selected' : ''}}>Viernes</option>
                                <option value="6" {{ old('dia_semana_inicio') == 6 ? 'selected' : ''}}>Sábado</option>
                                <option value="0" {{ old('dia_semana_inicio') == 0 ? 'selected' : ''}}>Domingo</option>                                    
                            </select>

                            @if ($errors->has('dia_semana_inicio'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('dia_semana_inicio') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 {{ $errors->has('hora_inicio') ? ' has-error' : '' }}">
                            <input id="hora_inicio" type="time" class="form-control" name="hora_inicio" value="{{ old('hora_inicio') }}" required >

                            @if ($errors->has('hora_inicio'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('hora_inicio') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <br>

                    <div class="form-group {{ $errors->has('dia_semana_fin') ? ' has-error' : '' }}">
                        <div class="col">
                            <label for="dia_semana_fin" >{{ __('Fin del turno') }}</label>
                        </div>

                        <div class="col-md-6">
                            <select name="dia_semana_fin" id="dia_semana_fin" class="form-control" required> 
                                <option value="1" {{ old('dia_semana_fin') == 1 ? 'selected' : ''}}>Lunes</option>
                                <option value="2" {{ old('dia_semana_fin') == 2 ? 'selected' : ''}}>Martes</option>
                                <option value="3" {{ old('dia_semana_fin') == 3 ? 'selected' : ''}}>Miércoles</option>
                                <option value="4" {{ old('dia_semana_fin') == 4 ? 'selected' : ''}}>Jueves</option>
                                <option value="5" {{ old('dia_semana_fin') == 5 ? 'selected' : ''}}>Viernes</option>
                                <option value="6" {{ old('dia_semana_fin') == 6 ? 'selected' : ''}}>Sábado</option>
                                <option value="0" {{ old('dia_semana_fin') == 0 ? 'selected' : ''}}>Domingo</option>                                    
                            </select>

                            @if ($errors->has('dia_semana_fin'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('dia_semana_fin') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-md-6 {{ $errors->has('hora_final') ? ' has-error' : '' }}">
                            <input id="hora_final" type="time" class="form-control" name="hora_final" value="{{ old('hora_final') }}" required >

                            @if ($errors->has('hora_final'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('hora_final') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>                           

                </div>
                
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col text-right">
                            <a href="/horario" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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
@endsection


