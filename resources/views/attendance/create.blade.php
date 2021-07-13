@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-4 col-md-offset-4" style="padding-top: .90em;">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar mi asistencia</h3>
            </div>
            <form method="POST" action="/attendance">
                @csrf
                @method('POST')
                
                <div class="box-body" style="margin-top: .50em;">

                    {{-- <div class="container">
                        <p>Hora actual</p>
                    </div> --}}

                    <div class=" form-group {{ $errors->has('dni') ? ' has-error' : '' }}"  >

                        <label for="dni">Ingrese su número de DNI para registrar su asistencia</label>
                        <div>
                            <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" placeholder="Número de DNI" required autofocus maxlength="8" pattern="[0-9]{8}" title="Ingrese un número de DNI correcto">

                            @if ($errors->has('dni'))
                                <span class="help-block" role="alert">
                                    <strong>{{ $errors->first('dni') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>                    
                
                </div>

                <div class="box-footer">
                    <div class="form-group">
                        <div class="">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i>
                                {{ __('Marcar asistencia') }}
                            </button>
                            <a href="/attendance" class="btn btn-default"> <i class="fa fa-remove"></i> Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection