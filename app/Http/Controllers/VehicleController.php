<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\User;

class VehicleController extends Controller
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
        $users = User::all();

        $vehicles = Vehicle::orderByDesc("id")->paginate(10);
        return view('vehicles.index', compact('vehicles', 'users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicles.create');
        
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
            'placa' => 'required|string|max:7|min:7',
            'nombres' => 'required|string|max:150',
            'apellidos' => 'required|string|max:150',
            'dni' => 'required|numeric|digits:8',
            'tipo_vehiculo' => 'required|string|max:50',
            'color' => 'required|string|max:25',
            'motivo' => 'required|string',
            'propiedad_epis' => 'required|numeric|min:0|max:1', 
        ]);



        $vehicle = new Vehicle;
        $vehicle->placa = $validatedData['placa'];
        $vehicle->conductor = $validatedData['nombres']." ".$validatedData['apellidos'];
        $vehicle->dni_conductor = $validatedData['dni'];
        $vehicle->tipo_vehiculo = $validatedData['tipo_vehiculo'];
        $vehicle->color = $validatedData['color'];
        $vehicle->motivo = $validatedData['motivo'];

        $vehicle->propiedad_epis = $validatedData['propiedad_epis'];

        $vehicle->estado = 0;
        $vehicle->login_id = Auth::user()->id;
        
        $vehicle->save();        
        
        return redirect('/vehicles');


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('vehicles.edit', ['vehicle'=>Vehicle::findOrFail($id)]);
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
            'placa' => 'required|string|min:7|max:7',
            'conductor' => 'required|string|max:150',
            'dni_conductor' => 'required|numeric|digits:8',
            'tipo_vehiculo' => 'required|string|max:50',
            'color' => 'required|string|max:25',
            'motivo' => 'required|string',
            'propiedad_epis' => 'required|numeric|min:0|max:1', 
        ]);

        $vehicle = Vehicle::findOrFail($id);
        $vehicle->placa = $validatedData['placa'];
        $vehicle->conductor = $validatedData['conductor'];
        $vehicle->dni_conductor = $validatedData['dni_conductor'];
        $vehicle->tipo_vehiculo = $validatedData['tipo_vehiculo'];
        $vehicle->color = $validatedData['color'];
        $vehicle->motivo = $validatedData['motivo'];

        $vehicle->propiedad_epis = $validatedData['propiedad_epis'];
        
        
        $vehicle->save();        
        
        return redirect('/vehicles');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();
        return redirect('/vehicles');
    }

    
    public function confirmDelete($id){
        
        return view('vehicles.confirmDelete', ['vehicle' => Vehicle::findOrFail($id)]);

    }

    public function marcarSalida($id){

        $vehicles = Vehicle::findOrFail($id);
        $vehicles->estado = 1;  
        $vehicles->leave_at = date("Y-m-d H:i:s");        
        $vehicles->save();        
        return redirect('/vehicles');
        
    }
}
