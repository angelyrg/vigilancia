<?php

namespace App\Http\Controllers;

use App\Office;
use App\Visitor;
use Illuminate\Http\Request;

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
        return view('home');
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
