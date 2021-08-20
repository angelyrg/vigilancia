@extends('layouts.adminlte')

@section('content')
<section class="content-header">
    <h1>
        Dashboard
        <small>Principal</small>
    </h1>
    <ol class="breadcrumb">
        <li class="active">Reportes</li>
    </ol>
</section>



<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-xs-6">               
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$vehicule_cant}}</h3>
        
                        <p>Vehículos registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <a href="/vehicles" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">               
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$incident_cant}}</h3>
        
                        <p>Incidentes registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-grav"></i>
                    </div>
                    <a href="/incidents" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">               
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$borrowing_cant}}</h3>
        
                        <p>Préstamos registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-object-group"></i>
                    </div>
                    <a href="/borrowings" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">               
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{$support_cant}}</h3>
        
                        <p>Apoyos realizados</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="/supports" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-md-8">
                <!--  CHART -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-inbox"></i> Visitantes </h3>            
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="visitorsChart" height="" ></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
        
            </div>

            <div class="col-md-4">
                <!--  CHART -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-inbox"></i> Visitantes </h3>            
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="visitorsChartPie" height="" ></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
        
            </div>
        </div>
    
    
    </div>
</section>
<form  id="form_visitantes" class="hidden">@csrf </form>
@endsection

@section('scripts')
<!-- ChartJS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>


// Visitantes Chart
obtenerVisitantes()
function obtenerVisitantes(){
    $.ajax({
        url:'home/visitors',
        method: 'post',
        data: $("#form_visitantes").serialize(),
        success: function(res){
            res = JSON.parse(res)
            var oficinas = [];
            let ctdVisitantes = [];
            
            res.forEach(element => {
                oficinas.push(element[0]);
                ctdVisitantes.push(element[1]);
            });

            myData = {
                labels: oficinas,
                datasets: [
                    {
                        label: 'Cantidad de visitantes',
                        data: ctdVisitantes,
                        //borderColor: '#000',
                        backgroundColor: ['#04a45c','#06c3eb','#f46d54','#e0e2e4','#3c8cbc','#f49c14','#80cdd3','#2cb677',],
                    }
                ]
            };

            console.log(myData);

            dibujar();

            dibujarPie();

        },
        error : function(xhr, status) {
            console.log("Hubo un problema al intentar obtener datos de los primeros puestos");
        },
    });
}
let visitantesChart;
function dibujar(){
    var ctx = document.getElementById('visitorsChart').getContext('2d');
    if(visitantesChart != null){
        visitantesChart.destroy();
    }

    var promedioEtas = new Chart(ctx, {
        type: 'bar',
        data: myData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        reverse: false,
                        stepSize: 1,                        
                    },
                },
                
                    
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Cantidad de visitantes por oficinas'
                },
            },
        },
    });

}

function dibujarPie(){
    var ctx = document.getElementById('visitorsChartPie').getContext('2d');
    if(visitantesChart != null){
        visitantesChart.destroy();
    }

    var promedioEtas = new Chart(ctx, {
        type: 'pie',
        data: myData,
        options: {

            responsive: true,

  
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Cantidad de visitantes por oficinas'
                },
            },
        },
    });

}

// Visitantes Chart Fin




</script>
@endsection
