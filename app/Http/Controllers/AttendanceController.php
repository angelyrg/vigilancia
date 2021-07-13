<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        //$request->user()->authorizeRoles(['admin', 'vigilante']);

        $attendances = Attendance::paginate(10);

        return view('attendance.index',compact('attendances'));
    }


    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'vigilante']);

        return view('attendance.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'dni' => 'required|numeric|digits:8|unique:users',
        ]);

        $attendance = new Attendance();
        
        $attendance->save();
        
        
        return redirect('/attendance');
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validatedData = $request->validate([

            'dni' => 'required|numeric|digits:8|unique:users',
        ]);
        
        $attendance->name = $validatedData['name'];

        $attendance->save();
        

        return redirect('/attendance');
    }

}
