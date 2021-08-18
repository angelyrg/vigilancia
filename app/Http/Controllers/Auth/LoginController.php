<?php

namespace App\Http\Controllers\Auth;

use App\Horario;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;


class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Authenticate with DNI number
    public function username(){
        return 'dni';
    }

    protected function credentials(Request $request)
    {   
        //$turno = Horario::findOrFail($request->id);

        return [
            'dni' => $request->dni,
            'password' => $request->password, 
            'active' => '1',
            // 'turno' => 
            //     function ($attribute, $value, $fail) use ($request) {
            //         if ( !($value==0 && $request['dia_semana_inicio']==6)){
            //             if ( $value < $request['dia_semana_inicio'] ) {
            //                 $fail('El día de fin del turno debe ser posterior o igual al día inicial.');
            //             }
            //         }
            //     },
            ];
    }
    
}
