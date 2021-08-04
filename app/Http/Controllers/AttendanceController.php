<?php

namespace App\Http\Controllers;

use App\Attendance;
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

        $attendances = Attendance::where('user_id', Auth::user()->id)->orderByDesc("id")->paginate(10);
        $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

        // $attendances = $attendances::paginate(10);

        return view('attendance.index', compact('attendances', 'dias'));
    }


    public function create(Request $request)
    {
        $last = Attendance::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        return view('attendance.create', ['lastRegister' => $last]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
        ]);



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
