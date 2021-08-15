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
        $vigilantes = User::all()->where('role_id', 2);

        $horarios = Horario::all();
        return view("horario.index", ["horarios" => $horarios, 'dias'=>$dias, 'vigilantes' => $vigilantes]);
    }


    // public function create()
    // {
    //     $horarios = Horario::all();
    //     $vigilantes = User::all()->where('role_id', 2)->where('active', 1);

    //     //return $vigilantes;

    //     return view("horario.create", ["vigilantes" => $vigilantes, "horarios" => $horarios]);

    // }

    // public function registrarHorario($id)
    // {
    //     $horarios = Horario::all();
    //     $vigilantes = User::all()->where('role_id', 2)->where('active', 1);

    //     //return $vigilantes;

    //     return view("horario.create", ["vigilantes" => $vigilantes, "horarios" => $horarios]);

    // }



    public function store(Request $request)
    {
        //return $request;

        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'turno' => 'required|numeric',

            // 'hora_inicio' => 'required|date_format:H:i',
            // 'hora_final' => [
            //     'required',
            //     function ($attribute, $value, $fail) use ($request) {
            //         if ($request['dia_semana_inicio'] == $request['dia_semana_fin']){
            //             if ( $value <= $request['hora_inicio'] ) {
            //                 $fail('La hora de fin de turno debe ser mayor que el inicial.');
            //             }
            //         }
            //     },
            // ]
        ]);

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
