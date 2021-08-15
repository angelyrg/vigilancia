<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use Illuminate\Support\Facades\Auth;
use App\Horario;

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
        $vehicles = Vehicle::orderByDesc("id")->paginate(10);
        return view('vehicles.index', compact('vehicles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

        if (Auth::user()->role_id == 1 ) {
            return view('vehicles.create');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('vehicles.create');
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('vehicles.create');
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('vehicles.create');
                }
            }
            return redirect('/vehicles')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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
            'placa' => 'required|string|max:7|min:7',
            'conductor' => 'required|string|max:150',
            'dni_conductor' => 'required|numeric|digits:8',
            'tipo_vehiculo' => 'required|string|max:50',
            'color' => 'required|string|max:25',
            'motivo' => 'required|string',
            'propiedad_epis' => 'required|numeric|min:0|max:1', 
        ]);

        $vehicle = new Vehicle;
        $vehicle->placa = $validatedData['placa'];
        $vehicle->conductor = $validatedData['conductor'];
        $vehicle->dni_conductor = $validatedData['dni_conductor'];
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
            return view('vehicles.edit', ['vehicle'=>Vehicle::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('vehicles.edit', ['vehicle'=>Vehicle::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('vehicles.edit', ['vehicle'=>Vehicle::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('vehicles.edit', ['vehicle'=>Vehicle::findOrFail($id)]);
                }
            }
            return redirect('/vehicles')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
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
        

        if (Auth::user()->role_id == 1 ) {
            return view('vehicles.confirmDelete', ['vehicle' => Vehicle::findOrFail($id)]);
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    return view('vehicles.confirmDelete', ['vehicle' => Vehicle::findOrFail($id)]);
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    return view('vehicles.confirmDelete', ['vehicle' => Vehicle::findOrFail($id)]);
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    return view('vehicles.confirmDelete', ['vehicle' => Vehicle::findOrFail($id)]);
                }
            }
            return redirect('/vehicles')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }

    }

    public function marcarSalida($id){

        

        if (Auth::user()->role_id == 1 ) {
            $vehicles = Vehicle::findOrFail($id);
            $vehicles->estado = 1;  
            $vehicles->leave_at = date("Y-m-d H:i:s");        
            $vehicles->save();        
            return redirect('/vehicles');
        } else {
            $misHorarios = Horario::where('user_id', Auth::user()->id)->get();
            foreach ($misHorarios as $item) {
    
                if (date('w')*2 + 1 == $item['turno'] && date('H:m:i') >= '06:00:00' && date('H:m:i') <= '18:00:00' ) {
                    $vehicles = Vehicle::findOrFail($id);
                    $vehicles->estado = 1;  
                    $vehicles->leave_at = date("Y-m-d H:i:s");        
                    $vehicles->save();        
                    return redirect('/vehicles');
                }else if(date('w')*2 + 2 == $item['turno'] && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '23:59:59'){
                    $vehicles = Vehicle::findOrFail($id);
                    $vehicles->estado = 1;  
                    $vehicles->leave_at = date("Y-m-d H:i:s");        
                    $vehicles->save();        
                    return redirect('/vehicles');
                }else if($item['turno'] == 14 && date('H:m:i') >= '00:00:00' && date('H:m:i') <= '06:00:00'){
                    $vehicles = Vehicle::findOrFail($id);
                    $vehicles->estado = 1;  
                    $vehicles->leave_at = date("Y-m-d H:i:s");        
                    $vehicles->save();        
                    return redirect('/vehicles');
                }
            }
            return redirect('/vehicles')->with('messageNoHorario', 'Usted no está en su horario de trabajo.');
        }


    }
}
