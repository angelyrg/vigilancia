<?php

namespace App\Http\Controllers;

use App\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidents = Incident::paginate(10);
        return view('incidents.index', compact('incidents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('incidents.create');
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
        return view('incidents.edit', ['incident'=>Incident::findOrFail($id)]);
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
            'nombre_incidente' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
        ]);

        $incident = Incident::findOrFail($id);
        $incident->nombre_incidente = $validatedData['nombre_incidente'];
        $incident->descripcion = $validatedData['descripcion'];
        
        $incident->save();        
        
        return redirect('/incidents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
