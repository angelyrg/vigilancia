@extends('layouts.adminlte')

@section('content')

    <section class="content-header">
        <h1>Perfil de usuario</h1>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        @if ($user->user_photo != null)                        
                            <img class="profile-user-img img-responsive img-circle" src="{{asset('img/'.$user->user_photo)}} " alt="User profile picture">
                        @else
                            <img class="profile-user-img img-responsive img-circle" src="{{asset('/adminlte/img/user-default.jpg')}} " alt="User profile picture">
                        @endif

                        <h3 class="profile-username text-center">{{$user->name." ".$user->lastname}}</h3>

                        <p class="text-muted text-center">{{$user->role->description}}</p>


                        <a href="/home" class="btn btn-primary btn-block"><b>Dashboard</b></a>

                    </div>
                </div>

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Acerca de mí</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> DNI</strong>
                        <p class="text-muted">{{$user->dni}}</p>

                        <hr>

                        <strong><i class="fa fa-mobile margin-r-5"></i> Celular</strong>
                        <p class="text-muted">{{$user->phone}}</p>

                        <hr>

                        <strong><i class="fa fa-calendar margin-r-5"></i> Fecha de registro</strong>
                        <p>{{$user->created_at->format('d/m/Y h:i A')}}</p>

                        <hr>

                        <strong><i class="fa fa-dot-circle-o margin-r-5"></i> Estado de cuenta</strong>
                        <p>
                            @if ($user->active == 1)
                                <span class="label label-success">Activo</span>
                            @else
                                <span class="label label-danger">Desactivado</span>
                            @endif
                           
                        </p>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-9">

                {{-- Cambiar mis datos personales --}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cambiar mis datos personales</h3>
            
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="/profile/{{$user->id}}/updateProfile" class="form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            @method('put')

                            <div class="form-group row {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">{{ __('Nombres') }}</label>
    
                                <div class="col-md-9">
                                    <input id="name" type="text" class="form-control" name="name" value="@if(!old('name')){{$user->name}}@else{{old('name')}}@endif" required autofocus>
    
                                    @if ($errors->has('name'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row {{ $errors->has('role_id') ? ' has-error' : '' }}">
                                <label for="lastname" class="col-md-3 control-label">{{ __('Apellidos') }}</label>
    
                                <div class="col-md-9">
                                    <input id="lastname" type="text" class="form-control" name="lastname" value="@if(!old('lastname')){{$user->lastname}}@else{{old('lastname')}}@endif" required >
    
                                    @if ($errors->has('lastname'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-md-3 control-label">{{ __('Celular') }}</label>
    
                                <div class="col-md-9">
                                    <input id="phone" type="text" class="form-control" name="phone" value="@if(!old('phone')){{$user->phone}}@else{{old('phone')}}@endif" required maxlength="9" pattern="[0-9]{9}" title="Ingrese un número de celular correcto">
    
                                    @if ($errors->has('phone'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row {{ $errors->has('user_photo') ? ' has-error' : '' }}">
                                <label for="user_photo" class="col-md-3 control-label">{{ __('Foto de perfil') }}</label>
    
                                <div class="col-md-9">
                                    <input id="user_photo" type="file" class="form-control" name="user_photo" value="@if(!old('user_photo')){{$user->user_photo}}@else{{old('user_photo')}}@endif" >
    
                                    @if ($errors->has('user_photo'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('user_photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-3 control-label">{{ __('Contraseña') }}</label>
    
                                <div class="col-md-9">
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Escribe tu contraseña para actualizar tus datos">
    
                                    @if ($errors->has('password'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-3">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save"></i> Actualizar datos
                                    </button>
                                </div>
                            </div>



                            @if(Session::has('messageProfile'))
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="box box-success direct-chat direct-chat-success" style="height: 80px">
                                        <div class="box-header with-border">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
    
                                        <div class="box-body ">
                                            <div class="direct-chat-messages">
                                                <div class="direct-chat-msg right">                                                
                                                    <img class="direct-chat-img " src="{{asset('img/check-green.png')}}" >
                                                    <div class="direct-chat-text">
                                                        {{Session::get('messageProfile')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </form>
                    </div>
                    <div class="box-footer"></div>
                </div>

                {{-- Cambiar contraseña --}}
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cambiar contraseña</h3>
            
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="/profile/{{$user->id}}/changePassword" class="form-horizontal" >
                            @csrf
                            @method('put')

                            <div class="form-group row {{ $errors->has('contrasena_actual') ? ' has-error' : '' }}">
                                <label for="contrasena_actual" class="col-md-3 control-label">{{ __('Contraseña actual') }}</label>
    
                                <div class="col-md-9">
                                    <input id="contrasena_actual" type="password" class="form-control" name="contrasena_actual" value="{{old('contrasena_actual')}}" required autofocus placeholder="Escribir tu contraseña actual">
                                    @if ($errors->has('contrasena_actual'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('contrasena_actual') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row {{ $errors->has('contrasena_nueva') ? ' has-error' : '' }}">
                                <label for="contrasena_nueva" class="col-md-3 control-label">{{ __('Nueva contraseña') }}</label>
    
                                <div class="col-md-9">
                                    <input id="contrasena_nueva" type="password" class="form-control" name="contrasena_nueva" value="{{old('contrasena_nueva')}}" required placeholder="Escribe tu nueva contraseña">
                                    @if ($errors->has('contrasena_nueva'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('contrasena_nueva') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('contrasena_confirmar') ? ' has-error' : '' }}">
                                <label for="contrasena_confirmar" class="col-md-3 control-label">{{ __('Repetir nueva contraseña') }}</label>
    
                                <div class="col-md-9">
                                    <input id="contrasena_confirmar" type="password" class="form-control" name="contrasena_confirmar" value="{{old('contrasena_confirmar')}}" placeholder="Repite tu nueva contraseña">
    
                                    @if ($errors->has('contrasena_confirmar'))
                                        <span class="help-block" role="alert">
                                            <strong>{{ $errors->first('contrasena_confirmar') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
            
    
    
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-key"></i> Cambiar contraseña
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if(Session::has('messagePasssword'))
                                <div class="col-md-offset-3 col-md-9">
                                    <div class="box box-info direct-chat direct-chat-success" style="height: 80px">
                                        <div class="box-header with-border">
                                            <div class="box-tools pull-right">
                                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
    
                                        <div class="box-body ">
                                            <div class="direct-chat-messages">
                                                <div class="direct-chat-msg right">                                                
                                                    <img class="direct-chat-img " src="{{asset('img/check-green.png')}}" >
                                                    <div class="direct-chat-text">
                                                        {{Session::get('messagePasssword')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                    </div>
                    <div class="box-footer"></div>
                </div>
                
            </div>

        </div>

    </section>

@endsection

@section('scripts')
    <script>
        if (window.history.replaceState) { // verificamos disponibilidad
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
@endsection