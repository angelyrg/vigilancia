<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Horario;

class SupportController extends Controller
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
        $supports = Support::orderByDesc("id")->paginate(10);
        $vigilantes = User::all()->where('role_id', 2);
        return view('supports.index', ['supports'=>$supports, 'vigilantes'=>$vigilantes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        if (Auth::user()->role_id == 1 ) {
            $vigilantes = User::all()->where('role_id', 2);
            return view('supports.create', ['vigilantes'=>$vigilantes]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $vigilantes = User::all()->where('role_id', 2);
                    return view('supports.create', ['vigilantes'=>$vigilantes]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $vigilantes = User::all()->where('role_id', 2);
                    return view('supports.create', ['vigilantes'=>$vigilantes]);

                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $vigilantes = User::all()->where('role_id', 2);
                    return view('supports.create', ['vigilantes'=>$vigilantes]);

                }
            }
            return redirect('/supports')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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

            'vigilante_id' => 'required',
            'oficina' => 'required|string|max:100',
            'documento' => 'required|string|max:50',
            'destino' => 'required|string|max:100',

        ]);

        $support = new Support;
        $support->vigilante_id = $validatedData['vigilante_id'];
        $support->oficina = $validatedData['oficina'];
        $support->documento = $validatedData['documento'];
        $support->destino = $validatedData['destino'];

        $support->estado = 0;
        $support->login_id = Auth::user()->id;
        
        $support->save();        
        
        return redirect('/supports');

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
            $vigilantes = User::all()->where('role_id', 2);
            return view('supports.edit', ['support'=>Support::findOrFail($id), 'vigilantes'=>$vigilantes]);
    
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $vigilantes = User::all()->where('role_id', 2);
                    return view('supports.edit', ['support'=>Support::findOrFail($id), 'vigilantes'=>$vigilantes]);
            
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $vigilantes = User::all()->where('role_id', 2);
                    return view('supports.edit', ['support'=>Support::findOrFail($id), 'vigilantes'=>$vigilantes]);
            
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $vigilantes = User::all()->where('role_id', 2);
                    return view('supports.edit', ['support'=>Support::findOrFail($id), 'vigilantes'=>$vigilantes]);
            
                }
            }
            return redirect('/supports')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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

            'vigilante_id' => 'required',
            'oficina' => 'required|string|max:100',
            'documento' => 'required|string|max:50',
            'destino' => 'required|string|max:100',

        ]);

        $support = Support::findOrFail($id);
        $support->vigilante_id = $validatedData['vigilante_id'];
        $support->oficina = $validatedData['oficina'];
        $support->documento = $validatedData['documento'];
        $support->destino = $validatedData['destino'];

        $support->save();        
        
        return redirect('/supports');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();
        return redirect('/supports');
    }

    public function confirmDelete($id){
        

        if (Auth::user()->role_id == 1 ) {
            return view('supports.confirmDelete', ['support' => Support::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('supports.confirmDelete', ['support' => Support::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('supports.confirmDelete', ['support' => Support::findOrFail($id)]);

                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('supports.confirmDelete', ['support' => Support::findOrFail($id)]);

                }
            }
            return redirect('/supports')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


    }

    public function retorno($id){
        

        if (Auth::user()->role_id == 1 ) {
            $support = Support::findOrFail($id);
            $support->estado = 1;  
            $support->fecha_retorno = date("Y-m-d H:i:s");        
            $support->save();        
            return redirect('/supports');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $support = Support::findOrFail($id);
                    $support->estado = 1;  
                    $support->fecha_retorno = date("Y-m-d H:i:s");        
                    $support->save();        
                    return redirect('/supports');
        
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $support = Support::findOrFail($id);
                    $support->estado = 1;  
                    $support->fecha_retorno = date("Y-m-d H:i:s");        
                    $support->save();        
                    return redirect('/supports');
        

                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $support = Support::findOrFail($id);
                    $support->estado = 1;  
                    $support->fecha_retorno = date("Y-m-d H:i:s");        
                    $support->save();        
                    return redirect('/supports');
        

                }
            }
            return redirect('/supports')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }



    }

}
