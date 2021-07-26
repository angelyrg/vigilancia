<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderByDesc("id")->paginate(10);
        return view('teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nombres' => 'required|string|max:75',
            'apellidos' => 'required|string|max:100',
            'dni' => 'required|numeric|digits:8',
            'descripcion' => 'required|string',
        ]);

        $teacher = new Teacher;
        $teacher->nombres = $validatedData['nombres'];
        $teacher->apellidos = $validatedData['apellidos'];
        $teacher->dni = $validatedData['dni'];
        $teacher->descripcion = $validatedData['descripcion'];
        $teacher->estado = 0;
        $teacher->login_id = Auth::user()->id;
        
        $teacher->save();        
        
        return redirect('/teachers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('teachers.edit', ['teacher'=>Teacher::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nombres' => 'required|string|max:75',
            'apellidos' => 'required|string|max:100',
            'dni' => 'required|numeric|digits:8',
            'descripcion' => 'required|string',
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->nombres = $validatedData['nombres'];
        $teacher->apellidos = $validatedData['apellidos'];
        $teacher->dni = $validatedData['dni'];
        $teacher->descripcion = $validatedData['descripcion'];
        $teacher->login_id = Auth::user()->id;
        
        $teacher->save();        
        
        return redirect('/teachers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect('/teachers');
    }

    public function confirmDelete($id){
        return view('teachers.confirmDelete', ['teacher' => Teacher::findOrFail($id)]);
    }

    public function marcarSalida($id){

        $teacher = Teacher::findOrFail($id);
        $teacher->estado = 1;  
        $teacher->leave_at = date("Y-m-d H:i:s");        
        $teacher->save();        
        
        return redirect('/teachers');
    }
}
