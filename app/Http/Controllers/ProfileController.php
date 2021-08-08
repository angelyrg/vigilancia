<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;


class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function profile(){
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('user.profile', compact('user'));
    }


    public function updateProfile(Request $request, $id){

        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'phone' => 'required|numeric|digits:9',
            'password' => [
                'required',
                function ($attribute, $value, $fail) use ($request, $user) {
                    if ( !(Hash::check($value, $user->password))){
                        $fail('La contraseña es incorrecta');
                    }
                },
            ],
        ]);

        if($request->hasFile('user_photo')){
            $file = $request->file('user_photo');
            $name_file = time().$file->getClientOriginalName();
            $file->move(public_path().'/img/', $name_file);
    
            $file_path = public_path().'/img/'.$user->user_photo;
            File::delete($file_path);

            $user->user_photo = $name_file;
        }


        
        $user->name = $validatedData['name'];
        $user->lastname = $validatedData['lastname'];
        $user->phone = $validatedData['phone'];

        $user->save();

        return redirect('/profile')->with('messageProfile', 'Datos actualizados correctamente');
    }


    public function changePassword(Request $request, $id){

        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            
            'contrasena_actual' => [
                'required',
                function ($attribute, $value, $fail) use ($request, $user) {
                    if ( !(Hash::check($value, $user->password))){
                        $fail('La contraseña es incorrecta');
                    }
                },
            ],

            'contrasena_nueva' => 'required',

            'contrasena_confirmar' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ( $value != $request['contrasena_nueva']){

                        $fail('Las nuevas contraseñas no coinciden');
                    }
                },
            ],
        ]);

        $user->password = Hash::make($validatedData['contrasena_nueva']);

        $user->save();

        return redirect('/profile')->with('messagePasssword', 'Contraseña cambiada correctamente');

    }



}
