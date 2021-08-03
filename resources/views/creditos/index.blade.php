@extends('layouts.adminlte')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créditos</div>

                <div class="card-body">
                    <h1>Equipo de desarrollo</h1>



                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-md-4 col-md-offset-4">
            <div class="box box-widget widget-user">
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">Gilmer Simón Matos Vila</h3>
                <h5 class="widget-user-desc">SCRUM MASTER</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle" src="{{ asset("img/gilmer-simon.jpg") }}" alt="User Avatar">
            </div>
            <div class="box-footer">
                
            </div>
            </div>
            <!-- /.widget-user -->
          </div>

    </div>

    <div class="row">

        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">Angel G. Yaranga Garcia</h3>
                    <h5 class="widget-user-desc">SCRUM TEAM</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/angel-yaranga.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">John Anderson Carbajal Quispe</h3>
                    <h5 class="widget-user-desc">SCRUM TEAM</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/john-carbajal.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">Yeris Nieves Casihue Escobar</h3>
                    <h5 class="widget-user-desc">SCRUM TEAM</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/yeris-ce.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">                    
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-green">
                    <h3 class="widget-user-username">Rebeca Belito Sullcaray</h3>
                    <h5 class="widget-user-desc">SCRUM TEAM</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset("img/rebeca-belito.jpg") }}" alt="User Avatar">
                </div>
                <div class="box-footer">                    
                </div>
            </div>
        </div>

    </div>


</div>
@endsection
