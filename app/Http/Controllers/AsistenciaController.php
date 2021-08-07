<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsistenciaController extends Controller
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

        return view("asistencia.index", ["asistencia" => 'asistencias']);


        //return view("horario.index", ["vigilantes" => User::all()->where('role_id', 2), 'dias'=>$dias]);
        
    }
}
