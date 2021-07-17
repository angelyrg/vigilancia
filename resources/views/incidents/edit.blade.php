@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro</h3>
            </div>
            <form method="POST" action="/incidents/{{$incident->id}}">
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group {{$errors->has('nombre_incidente') ? ' has-error' : ''}}">
                        <label for="nombres" >{{ __('Incidente') }}</label>

                        <div >
                            <input id="nombre_incidente" type="text" class="form-control" name="nombre_incidente" value="@if(!old('nombre_incidente')){{$incident->nombre_incidente}}@else{{old('nombre_incidente')}}@endif" required autofocus maxlength="50">

                            @if ($errors->has('nombre_incidente'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('nombre_incidente') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group {{$errors->has('descripcion') ? ' has-error' : ''}}">
                        <label for="descripcion" >{{ __('Descripción') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control" name="descripcion" required>@if(!old('descripcion')){{$incident->descripcion}}@else{{old('descripcion')}}@endif</textarea>
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
                            <a href="/incidents" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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