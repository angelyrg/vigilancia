@extends('layouts.adminlte')

@section('content')

    <div class="container col-md-6 col-md-offset-3">

        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">Editar registro de apoyo</h3>
            </div>
            <form method="POST" action="/supports/{{$support->id}}" >
                @csrf
                @method('put')
                
                <div class="box-body">

                    <div class="form-group ">
                        <label for="vigilante_id" >{{ __('Vigilante') }}</label>

                        <div >
                            <select name="vigilante_id" id="vigilante_id" class="form-control{{ $errors->has('vigilante_id') ? ' is-invalid' : '' }}" required>
                                <option value="">--Seleccione--</option>
                                @foreach ($vigilantes as $vigilante)
                                    @if ($support->vigilante->id  == $vigilante->id))
                                        <option value="{{$support->vigilante->id}}" selected>{{$support->vigilante->name." ".$support->vigilante->lastname}}</option>
                                    @else
                                        <option value="{{$vigilante->id}}">{{$vigilante->name." ".$vigilante->lastname}}</option>
                                    @endif

                                @endforeach
                            </select>

                            @if ($errors->has('vigilante_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('vigilante_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="oficina" >{{ __('Oficina') }}</label>

                        <div >
                            <input id="oficina" type="text" class="form-control{{ $errors->has('oficina') ? ' is-invalid' : '' }}" name="oficina" value="@if(!old('oficina')){{$support->oficina}}@else{{old('oficina')}}@endif" required maxlength="100">

                            @if ($errors->has('oficina'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('oficina') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="documento" >{{ __('Documento') }}</label>

                        <div >
                            <input id="documento" type="text" class="form-control{{ $errors->has('documento') ? ' is-invalid' : '' }}" name="documento" value="@if(!old('documento')){{$support->documento}}@else{{old('documento')}}@endif" required >

                            @if ($errors->has('documento'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('documento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label for="destino" >{{ __('Destino') }}</label>

                        <div >
                            <input id="destino" type="text" class="form-control{{ $errors->has('destino') ? ' is-invalid' : '' }}" name="destino" value="@if(!old('destino')){{$support->destino}}@else{{old('destino')}}@endif" required>

                            @if ($errors->has('destino'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('destino') }}</strong>
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
                            <a href="/supports" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                </div>
                
            </form>

        </div>

    </div>


@endsection