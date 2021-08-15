<?php

namespace App\Http\Controllers;

use App\Administrative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Horario;

class AdministrativeController extends Controller
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
        $administrative = Administrative::orderByDesc("id")->paginate(10);
        return view('administrative.index', compact('administrative'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        if (Auth::user()->role_id == 1 ) {
            return view('administrative.create');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('administrative.create');
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('administrative.create');
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('administrative.create');
                }
            }
            return redirect('/administrative')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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

        $administrative = new Administrative;
        $administrative->nombres = $validatedData['nombres'];
        $administrative->apellidos = $validatedData['apellidos'];
        $administrative->dni = $validatedData['dni'];
        $administrative->descripcion = $request->descripcion;
        $administrative->estado = 0;
        $administrative->login_id = Auth::user()->id;
        
        $administrative->save();        
        
        return redirect('/administrative');

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
            return view('administrative.edit', ['administrative'=>Administrative::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('administrative.edit', ['administrative'=>Administrative::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('administrative.edit', ['administrative'=>Administrative::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('administrative.edit', ['administrative'=>Administrative::findOrFail($id)]);
                }
            }
            return redirect('/administrative')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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

        $administrative = Administrative::findOrFail($id);
        $administrative->nombres = $validatedData['nombres'];
        $administrative->apellidos = $validatedData['apellidos'];
        $administrative->dni = $validatedData['dni'];
        $administrative->descripcion = $request->descripcion;
        $administrative->login_id = Auth::user()->id;
        
        $administrative->save();        
        
        return redirect('/administrative');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $administrative = Administrative::findOrFail($id);
        $administrative->delete();
        return redirect('/administrative');
    }

    public function confirmDelete($id){
        

        if (Auth::user()->role_id == 1 ) {
            return view('administrative.confirmDelete', ['administrative' => Administrative::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('administrative.confirmDelete', ['administrative' => Administrative::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('administrative.confirmDelete', ['administrative' => Administrative::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('administrative.confirmDelete', ['administrative' => Administrative::findOrFail($id)]);
                }
            }
            return redirect('/administrative')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


    }

    public function marcarSalida($id){

        


        if (Auth::user()->role_id == 1 ) {
            $administrative = Administrative::findOrFail($id);
            $administrative->estado = 1;  
            $administrative->leave_at = date("Y-m-d H:i:s");        
            $administrative->save();        
            return redirect('/administrative');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $administrative = Administrative::findOrFail($id);
                    $administrative->estado = 1;  
                    $administrative->leave_at = date("Y-m-d H:i:s");        
                    $administrative->save();        
                    return redirect('/administrative');
        
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $administrative = Administrative::findOrFail($id);
                    $administrative->estado = 1;  
                    $administrative->leave_at = date("Y-m-d H:i:s");        
                    $administrative->save();        
                    return redirect('/administrative');
        
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $administrative = Administrative::findOrFail($id);
                    $administrative->estado = 1;  
                    $administrative->leave_at = date("Y-m-d H:i:s");        
                    $administrative->save();        
                    return redirect('/administrative');
                    
                }
            }
            return redirect('/administrative')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


    }


}
