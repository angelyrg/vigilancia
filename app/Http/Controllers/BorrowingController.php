<?php

namespace App\Http\Controllers;

use App\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowings = Borrowing::orderByDesc("id")->paginate(10);
        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('borrowings.create');
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
            'nombre_bien' => 'required|string|max:75',
            'cantidad' => 'required|numeric',
            'nombre_encargado' => 'required|string|max:150',
            'descripcion' => 'required|string',
        ]);

        $borrowing = new Borrowing;
        $borrowing->nombre_bien = $validatedData['nombre_bien'];
        $borrowing->cantidad = $validatedData['cantidad'];
        $borrowing->nombre_encargado = $validatedData['nombre_encargado'];
        $borrowing->descripcion = $validatedData['descripcion'];

        $borrowing->estado = 0;
        $borrowing->login_id = Auth::user()->id;
        
        $borrowing->save();        
        
        return redirect('/borrowings');

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
        return view('borrowings.edit', ['borrowing'=>Borrowing::findOrFail($id)]);
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
            'nombre_bien' => 'required|string|max:75',
            'cantidad' => 'required|numeric',
            'nombre_encargado' => 'required|string|max:150',
            'descripcion' => 'required|string',
        ]);

        $borrowing = Borrowing::findOrFail($id);

        $borrowing->nombre_bien = $validatedData['nombre_bien'];
        $borrowing->cantidad = $validatedData['cantidad'];
        $borrowing->nombre_encargado = $validatedData['nombre_encargado'];
        $borrowing->descripcion = $validatedData['descripcion'];

        $borrowing->estado = 0;
        
        $borrowing->save();        
        
        return redirect('/borrowings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();
        return redirect('/borrowings');
    }


    public function confirmDelete($id){
        return view('borrowings.confirmDelete', ['borrowing' => Borrowing::findOrFail($id)]);
    }

    public function devolucion($id){

        $borrowing = Borrowing::findOrFail($id);
        $borrowing->estado = 1;  
        $borrowing->fecha_devolucion = date("Y-m-d H:i:s");        
        $borrowing->save();        
        
        return redirect('/borrowings');
    }


}
