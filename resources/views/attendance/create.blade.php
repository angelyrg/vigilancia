@extends('layouts.adminlte')



@section('content')


    <div class="container col-md-6 col-md-offset-3" style="padding-top: .90em;">
        
        <div class="box box-success ">
            <div class="box-header with-border">
                <h3 class="box-title">Registrar mi asistencia</h3>
            </div>
            @if ($misAsistencias == null || $misAsistencias->estado == 1)

                <form method="POST" action="/attendance">
                    @csrf
                    @method('POST')

            @elseif ($misAsistencias->estado == 0 )
                <form method="POST" action="/attendance/{{$misAsistencias->id}}">
                    @csrf
                    @method('put')
            @endif

                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >


                <div class="box-body" style="margin-top: .50em;">
                    <div class="row container-fluid text-center" >
                        <div class="text-center">

                            <div class="bg-success ">

                                <div class="date h3" >
                                    <span id="weekDay" class="weekDay"></span>, 
                                    <span id="day" class="day"></span> de
                                    <span id="month" class="month"></span> del
                                    <span id="year" class="year"></span>
                                </div>

                                <div id="clockdate" class="h4">
                                    <div class="clockdate-wrapper">
                                        <div id="clock"></div>
                                        <div id="date"></div>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                        <br>

                        <div class="col-sm-6 col-sm-offset-3" >

                            
                            @if (Session::has('message'))
                                
                                <div class="callout callout-warning">
                                    <h4><i class="fa fa-exclamation-circle"></i></h4>
                    
                                    <p>{{Session::get('message')}}</p>
                                  </div>

                            @else

                                @if ($misAsistencias != null )
                            
                                    @if ($misAsistencias->estado == 1)
                                            <button type="submit" id="bntInicial" class="btn btn-success" style="width:120px; height:100px; border-radius:7px;" >
                                                <i class="fa fa-sign-in fa-3x" aria-hidden="true" ></i><br>
                                                Registrar ingreso
                                            </button>
                                    @else
                                            <button type="submit" id="bntInicial" class="btn btn-success" style="width:120px; height:100px; border-radius:7px;">
                                                <i class="fa fa-sign-out fa-3x" aria-hidden="true" ></i><br>
                                                Registrar salida
                                            </button>
                                    @endif
                                @else
                                    <button type="submit" id="bntInicial" class="btn btn-success" style="width:120px; height:100px; border-radius:7px;" >
                                        <i class="fa fa-sign-in fa-3x" aria-hidden="true" ></i><br>
                                        Registrar ingreso
                                    </button>
                                @endif
                            @endif


                        </div>
  
                    </div>
                </div>



                <div class="box-footer">
                    <h4>??ltima vez:</h4>

                    @if ($misAsistencias != null )

                        @if ($misAsistencias->estado == 1)
                            <span class="label label-info"><i class="fa fa-sign-in"></i></span> Ingreso : <label> {{ $misAsistencias->created_at->format('d/m/Y h:i:s A')}}</label> <br>
                            <span class="label label-info"><i class="fa fa-sign-out"></i></span> Salida : <label> {{ $misAsistencias->updated_at->format('d/m/Y h:i:s A')}}</label> 
                        @else
                            <span class="label label-success"><i class="fa fa-sign-in"></i></span> Ingreso : <label> {{ $misAsistencias->created_at->format('d/m/Y h:i:s A')}}</label> 
                        @endif
                    @else
                        <span class="label label-info"><i class="fa fa-sign-in"></i></span> No hay registro previos <br>
                        <span class="label label-info"><i class="fa fa-sign-out"></i></span> No hay registro previos   
                    @endif

                    
                    <hr>
                    <div class=" text-center">        
                        <a href="/attendance" class="btn  btn-primary"> <i class="fa fa-list"></i> Mis asistencias</a>
                    </div>

                </div>
                
            </form>

        </div>

    </div>


@endsection

@section('scripts')
<script>

startTime()

function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + " : " + min + " : " + sec + " " + ap;
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}



var udateTime = function() {
    let currentDate = new Date(),
        hours = currentDate.getHours(),
        minutes = currentDate.getMinutes(), 
        seconds = currentDate.getSeconds(),
        weekDay = currentDate.getDay(), 
        day = currentDate.getDate(), 
        month = currentDate.getMonth(), 
        year = currentDate.getFullYear();
 
    const weekDays = [
        'Domingo',
        'Lunes',
        'Martes',
        'Mi??rcoles',
        'Jueves',
        'Viernes',
        'Sabado'
    ];
 
    document.getElementById('weekDay').textContent = weekDays[weekDay];
    document.getElementById('day').textContent = day;
 
    const months = [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
    ];
 
    document.getElementById('month').textContent = months[month];
    document.getElementById('year').textContent = year;
 

};
 
udateTime();
 
setInterval(udateTime, 1000);

    </script>
@endsection

