<?php

namespace App\Http\Controllers;

use App\Office;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Horario;

class VisitorController extends Controller
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
        $visitors = Visitor::orderByDesc("id")->paginate(10);
        return view('visitors.index', compact('visitors'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        if (Auth::user()->role_id == 1 ) {
            $offices = Office::all();
            return view('visitors.create', ['offices'=>$offices]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $offices = Office::all();
                    return view('visitors.create', ['offices'=>$offices]);
        
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $offices = Office::all();
                    return view('visitors.create', ['offices'=>$offices]);
        
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $offices = Office::all();
                    return view('visitors.create', ['offices'=>$offices]);
        
                }
            }
            return redirect('/visitors')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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
            'oficina_id' => 'required|numeric',
            'motivo' => 'required|string',
        ]);

        $visitor = new Visitor;
        $visitor->nombres = $validatedData['nombres'];
        $visitor->apellidos = $validatedData['apellidos'];
        $visitor->dni = $validatedData['dni'];
        $visitor->oficina_id = $validatedData['oficina_id'];
        $visitor->motivo = $validatedData['motivo'];
        $visitor->estado = 0;
        $visitor->login_id = Auth::user()->id;
        
        $visitor->save();        
        
        return redirect('/visitors');

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
            $offices = Office::all();
            return view('visitors.edit', ['visitor'=>Visitor::findOrFail($id), 'offices'=>$offices]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $offices = Office::all();
                    return view('visitors.edit', ['visitor'=>Visitor::findOrFail($id), 'offices'=>$offices]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $offices = Office::all();
                    return view('visitors.edit', ['visitor'=>Visitor::findOrFail($id), 'offices'=>$offices]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $offices = Office::all();
                    return view('visitors.edit', ['visitor'=>Visitor::findOrFail($id), 'offices'=>$offices]);
                }
            }
            return redirect('/visitors')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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
            'oficina_id' => 'required|numeric',
            'motivo' => 'required|string',
        ]);

        $visitor = Visitor::findOrFail($id);
        $visitor->nombres = $validatedData['nombres'];
        $visitor->apellidos = $validatedData['apellidos'];
        $visitor->dni = $validatedData['dni'];
        $visitor->oficina_id = $validatedData['oficina_id'];
        $visitor->motivo = $validatedData['motivo'];
        $visitor->login_id = Auth::user()->id;
        
        $visitor->save();        
        
        return redirect('/visitors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();
        return redirect('/visitors');
    }



    public function confirmDelete($id){
        

        if (Auth::user()->role_id == 1 ) {
            return view('visitors.confirmDelete', ['visitor' => Visitor::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('visitors.confirmDelete', ['visitor' => Visitor::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('visitors.confirmDelete', ['visitor' => Visitor::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('visitors.confirmDelete', ['visitor' => Visitor::findOrFail($id)]);
                }
            }
            return redirect('/visitors')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }

    }

    public function marcarSalida($id){

        

        if (Auth::user()->role_id == 1 ) {
            $visitor = Visitor::findOrFail($id);
            $visitor->estado = 1;  
            $visitor->leave_at = date("Y-m-d H:i:s");        
            $visitor->save();        
            return redirect('/visitors');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $visitor = Visitor::findOrFail($id);
                    $visitor->estado = 1;  
                    $visitor->leave_at = date("Y-m-d H:i:s");        
                    $visitor->save();        
                    return redirect('/visitors');
        
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $visitor = Visitor::findOrFail($id);
                    $visitor->estado = 1;  
                    $visitor->leave_at = date("Y-m-d H:i:s");        
                    $visitor->save();        
                    return redirect('/visitors');
        
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $visitor = Visitor::findOrFail($id);
                    $visitor->estado = 1;  
                    $visitor->leave_at = date("Y-m-d H:i:s");        
                    $visitor->save();        
                    return redirect('/visitors');
        
                }
            }
            return redirect('/visitors')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


    }


    public function historialVisitantes($id)
    {
        $v = Visitor::findOrFail($id);
        $visits = Visitor::where('dni', $v->dni)->orderBy('created_at', 'desc')->paginate(5);
        return view('visitors.historial', compact('visits'));
    }




}
