<?php

namespace App\Http\Controllers;

use App\Office;
use App\Visitor;
use Illuminate\Http\Request;

class OfficeController extends Controller
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
        $offices = Office::paginate(10);

        return view('offices.index', ['offices' => $offices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offices.create');
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
            'nombre_oficina' => 'required|string',
        ]);

        $office = new Office;
        $office->nombre_oficina = $validatedData['nombre_oficina'];

        $office->save();
        
        
        return redirect('/offices');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $office = Office::findOrFail($id);
        $office->delete();
        return redirect('/offices');
    }

    public function confirmDelete($id){
        return view('offices.confirmDelete', ['office' => Office::findOrFail($id)]);
    }


    public function historialOficinas($id)
    {
        $office = Office::findOrFail($id);

        //$visitors = Visitor::where('oficina_id', $id)->orderBy('created_at', 'desc')->get();
        $visitors = Visitor::where('oficina_id', $id)->orderBy('created_at', 'desc')->paginate(5);
        return view('offices.historial', compact('visitors', 'office'));
        


    }

}
