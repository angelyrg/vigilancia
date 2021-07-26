<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{

    public function __construct()
    {
        $this->middleware('authAdmin');
    }


    public function index(Request $request)
    {

        $attendances = Attendance::where('user_id', Auth::user()->id)->paginate(10);
        $dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");

        // $attendances = $attendances::paginate(10);

        return view('attendance.index', compact('attendances', 'dias'));
    }


    public function create(Request $request)
    {
        return view('attendance.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'required|numeric|digits:8',
        ]);

        $attendance = new Attendance();
        $attendance->dia_semana = date('w');
        $attendance->estado = 0;
        $attendance->user_id = Auth::user()->id;
        $attendance->save();
        
        return redirect('/attendance');
    }

    public function edit(Request $request, $id)
    {
        return view('attendance.edit', ['attendance'=>Attendance::findOrFail($id)]);
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([

            'dni' => 'required|numeric|digits:8',
        ]);

        $attendance->estado = 1;

        $attendance->save();
        

        return redirect('/attendance');
    }

}
