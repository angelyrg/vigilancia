<?php

namespace App\Http\Controllers;

use App\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $incidents = Incident::orderByDesc("id")->paginate(10);
        return view('incidents.index', compact('incidents'));
    }


    public function create()
    {
        return view('incidents.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_incidente' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
        ]);

        $incident = new Incident;
        $incident->nombre_incidente = $validatedData['nombre_incidente'];
        $incident->descripcion = $validatedData['descripcion'];

        $incident->login_id = Auth::user()->id;
        
        $incident->save();        
        
        return redirect('/incidents');
    }



    public function edit($id)
    {
        return view('incidents.edit', ['incident'=>Incident::findOrFail($id)]);
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre_incidente' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
        ]);

        $incident = Incident::findOrFail($id);
        $incident->nombre_incidente = $validatedData['nombre_incidente'];
        $incident->descripcion = $validatedData['descripcion'];
        
        $incident->save();        
        
        return redirect('/incidents');
    }


    public function destroy($id)
    {
        $incident = Incident::findOrFail($id);
        $incident->delete();
        return redirect('/incidents');
    }

    public function confirmDelete($id){
        return view('incidents.confirmDelete', ['incident' => Incident::findOrFail($id)]);
    }

}