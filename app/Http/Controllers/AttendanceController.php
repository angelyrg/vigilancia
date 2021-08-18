<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        if (Auth::user()->role_id == 1){
            $attendances = Attendance::orderByDesc("id")->paginate(10); 
        }else{
            $attendances = Attendance::where('user_id', Auth::user()->id)->orderByDesc("id")->paginate(10);
        }
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");


        return view('attendance.index', compact('attendances', 'dias'));


    }


    public function create()
    {
        $misAsistencias = Attendance::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();


        $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
        

        foreach ($misHorarios as $item) {
            //echo $item;
            if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                return view('attendance.create', ['miHorario' => $item, 'misAsistencias' => $misAsistencias]);

            }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                return view('attendance.create', ['miHorario' => $item, 'misAsistencias' => $misAsistencias]);

            }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                return view('attendance.create', ['miHorario' => $item, 'misAsistencias' => $misAsistencias]);

            }
        }

        return redirect('/attendance')->with('message', 'Usted no está en su horario de trabajo.');

    }


    public function store(Request $request)
    {

        $attendance = new Attendance();
        $attendance->estado = 0;
        $attendance->user_id = Auth::user()->id;
        $attendance->save();
        
        return redirect('/attendance');
    }

 

    public function update(Request $request, Attendance $attendance)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
        ]);

        $attendance->estado = 1;

        $attendance->save();
        

        return redirect('/attendance');
    }

}
