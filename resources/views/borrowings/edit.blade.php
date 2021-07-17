@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro</h3>
            </div>
            <form method="POST" action="/borrowings/{{$borrowing->id}}" >
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group {{$errors->has('nombre_bien') ? ' has-error' : ''}}">
                        <label for="nombre_bien" >{{ __('Bien') }}</label>

                        <div >
                            <input id="nombre_bien" type="text" class="form-control" name="nombre_bien" value="@if(!old('nombre_bien')){{$borrowing->nombre_bien}}@else{{old('nombre_bien')}}@endif" required autofocus placeholder="Nombre del bien">

                            @if ($errors->has('nombre_bien'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre_bien') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('cantidad') ? ' has-error' : ''}}">
                        <label for="cantidad" >{{ __('Cantidad') }}</label>

                        <div>
                            <input id="cantidad" type="number" class="form-control" name="cantidad" value="@if(!old('cantidad')){{$borrowing->cantidad}}@else{{old('cantidad')}}@endif" required >

                            @if ($errors->has('cantidad'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cantidad') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('nombre_encargado') ? ' has-error' : ''}}">
                        <label for="nombre_encargado" >{{ __('Encargado') }}</label>

                        <div >
                            <input id="nombre_encargado" type="text" class="form-control" name="nombre_encargado" value="@if(!old('nombre_encargado')){{$borrowing->nombre_encargado}}@else{{old('nombre_encargado')}}@endif" required placeholder="Nombre completo del encargado" >

                            @if ($errors->has('nombre_encargado'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre_encargado') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('descripcion') ? ' has-error' : ''}}">
                        <label for="descripcion" >{{ __('Descripción') }}</label>

                        <div >
                            <textarea cols="30" rows="4" class="form-control" name="descripcion" required>@if(!old('descripcion')){{$borrowing->descripcion}}@else{{old('descripcion')}}@endif</textarea>
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
                        <div class="col text-right">
                            <a href="/borrowings" class="btn btn-default"><i class="fa fa-remove"></i> Cancelar</a>
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