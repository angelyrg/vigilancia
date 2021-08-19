<?php

namespace App\Http\Controllers\Auth;

use App\User;
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


        $user = User::where('dni', $request->dni)->firstOrFail();
        $today = date('Y-m-d');

        if ($user != null) {

            // Validación de inicio de sesión en el tiempo de fecha de contrato
            if ($user->contract_start <= $today && $user->contract_end >= $today){
                
                if ($user->role_id == 1 ) {
                    return [
                        'dni' => $request->dni,
                        'password' => $request->password, 
                        'active' => '1',
                    ];
                } else {
    
                    $misHorarios = Horario::where('user_id', $user->id)->get();
                    foreach ($misHorarios as $item) {
    
                        if (date('H') >= 6 && date('H') <= 17){ //Turno día [6AM - 5PM]
    
                            if (date('w')*2 + 1 == $item['turno']  ) {
    
                                return [
                                    'dni' => $request->dni,
                                    'password' => $request->password, 
                                    'active' => '1',
                                ];
        
                            }
    
                        }else if(date('H') >= 18){ //Turno noche Anocher [6pm - >
    
                            if (date('w')*2 + 2 == $item['turno']  ) {
    
                                return [
                                    'dni' => $request->dni,
                                    'password' => $request->password, 
                                    'active' => '1',
                                ];
        
                            }
    
                        }
    
                        else if(date('H') <= 5 ){ //Turno noche Amanecer < - 5AM]
    
                            if (date('w')*2 == $item['turno']  ) {
    
                                return [
                                    'dni' => $request->dni,
                                    'password' => $request->password, 
                                    'active' => '1',
                                ];
        
                            }
    
                        }
                    }
                }
            }            
            return [
                'dni' => '0',
                'password' => '0', 
                'active' => '1',
                ]; 
        }else{
            return [
                'dni' => $request->dni,
                'password' => $request->password, 
                'active' => '1',
                ];
        }

        
    }
    
}
