<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Horario;

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
        //return view('teachers.create');

        if (Auth::user()->role_id == 1 ) {
            return view('teachers.create');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('teachers.create');
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('teachers.create');
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('teachers.create');
                }
            }
            return redirect('/teachers')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }

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
        ]);

        $teacher = new Teacher;
        $teacher->nombres = $validatedData['nombres'];
        $teacher->apellidos = $validatedData['apellidos'];
        $teacher->dni = $validatedData['dni'];
        $teacher->descripcion = $request->descripcion;
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
        

        if (Auth::user()->role_id == 1 ) {
            return view('teachers.edit', ['teacher'=>Teacher::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('teachers.edit', ['teacher'=>Teacher::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('teachers.edit', ['teacher'=>Teacher::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('teachers.edit', ['teacher'=>Teacher::findOrFail($id)]);
                }
            }
            return redirect('/teachers')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


        
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
        ]);

        $teacher = Teacher::findOrFail($id);
        $teacher->nombres = $validatedData['nombres'];
        $teacher->apellidos = $validatedData['apellidos'];
        $teacher->dni = $validatedData['dni'];
        $teacher->descripcion = $request->descripcion;
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

        if (Auth::user()->role_id == 1 ) {
            return view('teachers.confirmDelete', ['teacher' => Teacher::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('teachers.confirmDelete', ['teacher' => Teacher::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('teachers.confirmDelete', ['teacher' => Teacher::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('teachers.confirmDelete', ['teacher' => Teacher::findOrFail($id)]);
                }
            }
            return redirect('/teachers')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


    }

    public function marcarSalida($id){

        

        if (Auth::user()->role_id == 1 ) {
            $teacher = Teacher::findOrFail($id);
            $teacher->estado = 1;  
            $teacher->leave_at = date("Y-m-d H:i:s");        
            $teacher->save();        
            
            return redirect('/teachers');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $teacher = Teacher::findOrFail($id);
                    $teacher->estado = 1;  
                    $teacher->leave_at = date("Y-m-d H:i:s");        
                    $teacher->save();        
                    
                    return redirect('/teachers');
        

                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $teacher = Teacher::findOrFail($id);
                    $teacher->estado = 1;  
                    $teacher->leave_at = date("Y-m-d H:i:s");        
                    $teacher->save();        
                    
                    return redirect('/teachers');
        

                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $teacher = Teacher::findOrFail($id);
                    $teacher->estado = 1;  
                    $teacher->leave_at = date("Y-m-d H:i:s");        
                    $teacher->save();        
                    
                    return redirect('/teachers');
        

                }
            }
            return redirect('/teachers')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }

        
    }
}
