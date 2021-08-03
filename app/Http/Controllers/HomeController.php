<?php

namespace App\Http\Controllers;

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

    public function visitors()
    {
        $visitors = Visitor::all();

        return response(json_encode($visitors))->header('Content-type', 'text/plain');
    }

}
