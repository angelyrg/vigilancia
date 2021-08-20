<?php

namespace App\Http\Controllers;

use App\Borrowing;
use App\Incident;
use App\Office;
use App\Support;
use App\Visitor;
use App\Vehicle;




class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicule_cant = Vehicle::count();
        $incident_cant = Incident::count();
        $borrowing_cant = Borrowing::count();
        $support_cant = Support::count();




        return view('home', compact('vehicule_cant', 'incident_cant', 'borrowing_cant', 'support_cant' ));
    }


    public function visitors(){
        $offices = Office::all();
        $data = [];
        foreach ($offices as $of) {
            $temp = [];
            $cant = Visitor::all()->where('oficina_id' ,  $of->id)->count();
            array_push($temp, $of->nombre_oficina, $cant);
            array_push($data, $temp);
        }
        return response(json_encode($data))->header('Content-type', 'text/plain');
    }

    public function visitorsLastYear(){

        $today = date('Y-m-d');
        $oneYearAgo = strtotime ('-1 year' , strtotime($today)); //Se resta un año menos
        $oneYearAgo = date ('Y-m-d',$oneYearAgo);


        $datos = Visitor::all()->where('created_at', '>=', $oneYearAgo);

        echo $datos;

        $data = [];

        foreach ($datos as $value) {

            $temp = [];
            $cant = Visitor::all()->where('oficina_id' ,  $value->id)->count();
            array_push($temp, $value->nombre_oficina, $cant);
            array_push($data, $temp);
        }

        //return response(json_encode($data))->header('Content-type', 'text/plain');

    }





}
