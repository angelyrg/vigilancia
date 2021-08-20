<?php

namespace App\Http\Controllers;

use App\Horario;
use App\User;

use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('authAdmin');
    }

    
    public function index()
    {
        $dias = array("0"  => "Domingo","1"  => "Lunes","2"  => "Martes","3"  => "Miércoles","4"  => "Jueves","5"  => "Viernes","6"  => "Sábado");
        $vigilantes = User::all()->where('role_id', 2)->where('active', 1)->where('contract_start', '<=', date('Y-m-d'))->where('contract_end', '>=', date('Y-m-d'));
        $horarios = Horario::all();
        return view("horario.index", ["horarios" => $horarios, 'dias'=>$dias, 'vigilantes' => $vigilantes]);
    }



    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'turno' => 'required|numeric',
        ]);

        $horariosDelUsuario = Horario::where('user_id', $validatedData['user_id'])->get()  ;
        
        foreach ($horariosDelUsuario as $hs) {
            if ($validatedData['turno'] == $hs->turno ){
                
                return redirect('/horario')->with('message', 'El vigilante ya tiene asignado este turno.');
            }else if ($validatedData['turno'] == ($hs->turno + 1 ) || $validatedData['turno'] == ($hs->turno - 1 )){
                
                return redirect('/horario')->with('message', 'No se puede asignar dos turnos consecutivos al mismo vigilante');
            }
        }

        $horario = new Horario;
        $horario->user_id = $validatedData['user_id'];
        $horario->turno = $validatedData['turno'];
        $horario->save();
        return redirect('/horario');
    }


    public function destroy(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();
        return redirect('/horario');
    }

    public function confirmDelete($id){
        $horario = Horario::findOrFail($id);

        $vigilante = User::findOrFail($horario->user_id);

        return view('horario.confirmDelete', compact('horario', 'vigilante'));
    }
}
