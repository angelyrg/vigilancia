<?php

namespace App\Http\Controllers;

use App\Horario;
use App\User;

use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$day=date('w', strtotime(today()));

        $dias = array("1"  => "Lunes","2"  => "Martes","3"  => "Miércoles","4"  => "Jueves","5"  => "Viernes","6"  => "Sábado","7"  => "Domingo");
        
        $vigilantes = User::all()->where('role_id', 2);

        $horarios = Horario::orderByDesc("id")->paginate(10);

        return view("horario.index", ["horarios" => $horarios, 'dias'=>$dias, 'vigilantes' => $vigilantes]);


        //return view("horario.index", ["vigilantes" => User::all()->where('role_id', 2), 'dias'=>$dias]);



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vigilantes = User::all()->where('role_id', 2);

        //return $vigilantes;

        return view("horario.create", ["vigilantes" => $vigilantes]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;

        $validatedData = $request->validate([
            'user_id' => 'required|numeric',
            'dia_semana_inicio' => 'required|numeric',
            'dia_semana_fin' => 'required|numeric',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_final' => 'required|date_format:H:i',
        ]);

        $horario = new Horario;
        $horario->user_id = $validatedData['user_id'];
        $horario->dia_semana_inicio = $validatedData['dia_semana_inicio'];
        $horario->dia_semana_fin = $validatedData['dia_semana_fin'];
        $horario->hora_inicio = $validatedData['hora_inicio'];
        $horario->hora_final = $validatedData['hora_final'];

        $horario->save();
        
        
        return redirect('/horario');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$request->user()->authorizeRoles(['admin']);

        $horario = Horario::findOrFail($id);
        $horario->delete();
        return redirect('/horario');
    }

    public function confirmDelete($id){
        return view('horario.confirmDelete', ['horario' => Horario::findOrFail($id)]);
    }
}
