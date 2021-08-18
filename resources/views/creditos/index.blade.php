@extends('layouts.adminlte')

@section('content')
<section class="content-header">
    <h1>
        Créditos
        <small>Equipo de desarrollo</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">Reportes</li>
    </ol>
</section>
<br>
<div class="container">

    <div class="row">

        <div class="col-md-4 ">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-aqua-active ">
                    <h3 class="widget-user-username ">Mg. Ing. Gilmer S. Matos Vila </h3>
                    <h5 class="widget-user-desc">SCRUM MASTER</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/gilmer-simon.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-7 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-envelope"></i></h5>
                            <span >gilmer.matos@unh.edu.pe</span>
                            </div>
                        </div>
                        
                        <div class="col-sm-5">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-facebook"></i></h5>
                            <span class="label"><a href="https://www.facebook.com/catmavi" target="_blank">Ver perfil</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.widget-user -->
          </div>
    {{-- </div>

    <div class="row">
 --}}
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">Angel G. Yaranga Garcia</h3>
                    <h5 class="widget-user-desc">Team Developer Scrum</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/2017141050.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-7 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-envelope"></i></h5>
                            <span >angel.yaranga@unh.edu.pe</span>
                            </div>
                        </div>
                        
                        <div class="col-sm-5">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-facebook"></i></h5>
                            <span class="label"><a href="https://www.facebook.com/angel.y4g" target="_blank">Ver perfil</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">John Anderson Carbajal Quispe</h3>
                    <h5 class="widget-user-desc">Team Developer Scrum</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/john-carbajal.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-7 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-envelope"></i></h5>
                            <span >john.carbajal@unh.edu.pe</span>
                            </div>
                        </div>
                        
                        <div class="col-sm-5">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-facebook"></i></h5>
                            <span class="label"><a href="https://www.facebook.com/johnanderson.carbajalquispe.7" target="_blank">Ver perfil</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">Yeris Nieves Casihue Escobar</h3>
                    <h5 class="widget-user-desc">Team Developer Scrum</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/yeris-casihue.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-7 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-envelope"></i></h5>
                            <span >yeris.casihue@unh.edu.pe</span>
                            </div>
                        </div>
                        
                        <div class="col-sm-5">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-facebook"></i></h5>
                            <span class="label"><a href="https://www.facebook.com/yeris.casihueescobar" target="_blank">Ver perfil</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">Rebeca Belito Sullcaray</h3>
                    <h5 class="widget-user-desc">Team Developer Scrum</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/rebeca-belito.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-7 border-right">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-envelope"></i></h5>
                            <span >rebeca.belito@unh.edu.pe</span>
                            </div>
                        </div>
                        
                        <div class="col-sm-5">
                            <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-facebook"></i></h5>
                            <span class="label"><a href="https://www.facebook.com/rebeca.belitosullcaray" target="_blank">Ver perfil</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>
@endsection
