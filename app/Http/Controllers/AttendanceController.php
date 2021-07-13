<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['admin', 'vigilante']);

        $attendances = Attendance::where('user_id', Auth::user()->id)->paginate(10);
        $dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");

        // $attendances = $attendances::paginate(10);

        return view('attendance.index', compact('attendances', 'dias'));
    }


    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'vigilante']);

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
