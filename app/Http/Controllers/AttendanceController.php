<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Session\SessionManager;

class AttendanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {

        $attendances = Attendance::where('user_id', Auth::user()->id)->orderByDesc("id")->paginate(10);
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

        // $attendances = $attendances::paginate(10);

        return view('attendance.index', compact('attendances', 'dias'));
    }


    public function create( SessionManager $sessionManager)
    {
        $last = Attendance::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        $validarDia = Horario::where('user_id', Auth::user()->id)
                                ->where(function($query) {
                                    $query->where('dia_semana_inicio', date('w'))->where('hora_inicio', '<=', date("H:i:s"))
                                            ->orWhere('dia_semana_fin', date('w'))->where('hora_final', '>=', date("H:i:s"));
                                }) ->get();
  
        if (count($validarDia)== 0) {
            $sessionManager->flash('message', 'No tiene turno asignado para este momento');
        } 
        return view('attendance.create', ['lastRegister' => $last]);
        
        

    }


    public function store(Request $request)
    {

        $attendance = new Attendance();
        $attendance->dia_semana = date('w');
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
