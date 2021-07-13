@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro</h3>
            </div>
            <form method="POST" action="/incidents/{{$incident->id}}" aria-label="{{ __('Editar registro') }}">
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group ">
                        <label for="nombres" >{{ __('Incidente') }}</label>

                        <div >
                            <input id="nombre_incidente" type="text" class="form-control{{ $errors->has('nombre_incidente') ? ' is-invalid' : '' }}" name="nombre_incidente" value="@if(!old('nombre_incidente')){{$incident->nombre_incidente}}@else{{old('nombre_incidente')}}@endif" required autofocus maxlength="50">

                            @if ($errors->has('nombre_incidente'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre_incidente') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group ">
                        <label for="descripcion" >{{ __('Descripción') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" required>@if(!old('descripcion')){{$incident->descripcion}}@else{{old('descripcion')}}@endif</textarea>
                            @if ($errors->has('descripcion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('descripcion') }}</strong>
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
                            <a href="/incidents" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection