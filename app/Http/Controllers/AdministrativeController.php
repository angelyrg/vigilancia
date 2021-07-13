<?php

namespace App\Http\Controllers;

use App\Administrative;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministrativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $administrative = Administrative::paginate(10);
        return view('administrative.index', compact('administrative'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrative.create');
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
            'descripcion' => 'required|string',
        ]);

        $administrative = new Administrative;
        $administrative->nombres = $validatedData['nombres'];
        $administrative->apellidos = $validatedData['apellidos'];
        $administrative->dni = $validatedData['dni'];
        $administrative->descripcion = $validatedData['descripcion'];
        $administrative->estado = 0;
        $administrative->login_id = Auth::user()->id;
        
        $administrative->save();        
        
        return redirect('/administrative');

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
        return view('administrative.edit', ['administrative'=>Administrative::findOrFail($id)]);
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
            'descripcion' => 'required|string',
        ]);

        $administrative = Administrative::findOrFail($id);
        $administrative->nombres = $validatedData['nombres'];
        $administrative->apellidos = $validatedData['apellidos'];
        $administrative->dni = $validatedData['dni'];
        $administrative->descripcion = $validatedData['descripcion'];
        $administrative->login_id = Auth::user()->id;
        
        $administrative->save();        
        
        return redirect('/administrative');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $administrative = Administrative::findOrFail($id);
        $administrative->delete();
        return redirect('/administrative');
    }

    public function confirmDelete($id){
        return view('administrative.confirmDelete', ['administrative' => Administrative::findOrFail($id)]);
    }

    public function marcarSalida($id){

        $administrative = Administrative::findOrFail($id);
        $administrative->estado = 1;  
        $administrative->leave_at = date("Y-m-d H:i:s");        
        $administrative->save();        
        
        return redirect('/administrative');
    }


}
