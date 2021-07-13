@extends('layouts.adminlte')

@section('content')
<div class="container">


    <div class="container d-flex justify-content-center col-md-6">


                <div class="box box-primary ">
                    <div class="box-header with-border">
                        <h3 class="box-title">Asignar nuevo horario</h3>
                    </div>

                    
                    <form method="POST" action="/horario" aria-label="{{ __('Nuevo horario') }}">
                        @csrf
                        @method('POST')

                        <div class="box-body">

                            <div class="form-group ">
                                <label for="user_id">{{ __('Vigilante') }}</label>

                                <div class="">
                                    <select name="user_id" id="user_id" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" required> 
                                        <option value=""></option>
                                        @foreach ($vigilantes as $vigilante)
                                            <option value="{{$vigilante->id}}">{{$vigilante->name." ".$vigilante->lastname}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('user_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="dia_semana_inicio" >{{ __('Día de inicio') }}</label>

                                <div class="">
                                    <select name="dia_semana_inicio" id="dia_semana_inicio" class="form-control{{ $errors->has('dia_semana_inicio') ? ' is-invalid' : '' }}" required> 
                                        <option value="">-Inicio-</option>
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miércoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sábado</option>
                                        <option value="7">Domingo</option>                                    
                                    </select>

                                    @if ($errors->has('dia_semana_inicio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dia_semana_inicio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hora_inicio" >{{ __('Hora de inicio') }}</label>

                                <div class="">
                                    <input id="hora_inicio" type="time" class="form-control{{ $errors->has('hora_inicio') ? ' is-invalid' : '' }}" name="hora_inicio" value="{{ old('hora_inicio') }}" required >

                                    @if ($errors->has('hora_inicio'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('hora_inicio') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="dia_semana_fin" >{{ __('Día de finalización') }}</label>

                                <div class="">
                                    <select name="dia_semana_fin" id="dia_semana_fin" class="form-control{{ $errors->has('dia_semana_fin') ? ' is-invalid' : '' }}" required> 
                                        <option value="">-Finalización-</option>
                                        <option value="1">Lunes</option>
                                        <option value="2">Martes</option>
                                        <option value="3">Miércoles</option>
                                        <option value="4">Jueves</option>
                                        <option value="5">Viernes</option>
                                        <option value="6">Sábado</option>
                                        <option value="7">Domingo</option>                                    
                                    </select>

                                    @if ($errors->has('dia_semana_fin'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dia_semana_fin') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>                           


                            <div class="form-group ">
                                <label for="hora_final" >{{ __('Hora de finalización') }}</label>

                                <div class="">
                                    <input id="hora_final" type="time" class="form-control{{ $errors->has('hora_final') ? ' is-invalid' : '' }}" name="hora_final" value="{{ old('hora_final') }}" required >

                                    @if ($errors->has('hora_final'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('hora_final') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                        <div class="box-footer">
                            <div class="form-group ">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar') }}
                                    </button>
                                    <a href="/horario" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>      
                                              
                    </form>
                    

                
                </div>



    </div>

</div>
@endsection