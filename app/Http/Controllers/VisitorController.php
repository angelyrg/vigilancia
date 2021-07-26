<?php

namespace App\Http\Controllers;

use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
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
        $visitors = Visitor::orderByDesc("id")->paginate(10);
        return view('visitors.index', compact('visitors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitors.create');
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
            'motivo' => 'required|string',
        ]);

        $visitor = new Visitor;
        $visitor->nombres = $validatedData['nombres'];
        $visitor->apellidos = $validatedData['apellidos'];
        $visitor->dni = $validatedData['dni'];
        $visitor->motivo = $validatedData['motivo'];
        $visitor->estado = 0;
        $visitor->login_id = Auth::user()->id;
        
        $visitor->save();        
        
        return redirect('/visitors');

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
        return view('visitors.edit', ['visitor'=>Visitor::findOrFail($id)]);
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
            'motivo' => 'required|string',
        ]);

        $visitor = Visitor::findOrFail($id);
        $visitor->nombres = $validatedData['nombres'];
        $visitor->apellidos = $validatedData['apellidos'];
        $visitor->dni = $validatedData['dni'];
        $visitor->motivo = $validatedData['motivo'];
        $visitor->login_id = Auth::user()->id;
        
        $visitor->save();        
        
        return redirect('/visitors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::findOrFail($id);
        $visitor->delete();
        return redirect('/visitors');
    }



    public function confirmDelete($id){
        return view('visitors.confirmDelete', ['visitor' => Visitor::findOrFail($id)]);
    }

    public function marcarSalida($id){

        $visitor = Visitor::findOrFail($id);
        $visitor->estado = 1;  
        $visitor->leave_at = date("Y-m-d H:i:s");        
        $visitor->save();        
        
        return redirect('/visitors');
    }




}
