<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;




class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('authAdmin');
    } 


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::orderByDesc("id")->paginate(10);

        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'dni' => 'required|numeric|digits:8|unique:users',
            'phone' => 'required|numeric|digits:9',
            'role_id' => 'required|numeric|min:1|max:2',
            'contract_start' => 'required|date',
            'contract_end' => [
                'required','date',
                function ($attribute, $value, $fail) use ($request) {
                    if ( $value < $request['contract_start'] ) {
                        $fail('El día de finalización del contrato debe ser posterior al inicio del contrato.');
                    }
                },
            ],
            
        ]);

        $user = new User;
        $user->name = $validatedData['name'];
        $user->lastname = $validatedData['lastname'];
        $user->dni = $validatedData['dni'];
        $user->phone = $validatedData['phone'];
        $user->role_id = $validatedData['role_id'];
        $user->contract_start = $validatedData['contract_start'];
        $user->contract_end = $validatedData['contract_end'];
        $user->password = bcrypt($validatedData['dni']);
        $user->save();
        return redirect('/user');
    }

    public function edit(Request $request, $id)
    {
        return view('user.edit', ['user'=>User::findOrFail($id), 'roles' => Role::all()]);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'dni' => 'required|numeric|digits:8|unique:users,dni,'.$user->id,
            'phone' => 'required|numeric|digits:9',
            'role_id' => 'required|numeric|min:1|max:2',
            'active' => 'required|bool',
            'contract_start' => 'required|date',
            'contract_end' => [
                'required','date',
                function ($attribute, $value, $fail) use ($request) {
                    if ( $value < $request['contract_start'] ) {
                        $fail('El día de finalización del contrato debe ser posterior al inicio del contrato.');
                    }
                },
            ],

        ]);
        
        $user->name = $validatedData['name'];
        $user->lastname = $validatedData['lastname'];
        $user->dni = $validatedData['dni'];
        $user->phone = $validatedData['phone'];
        $user->role_id = $validatedData['role_id'];
        $user->active = $validatedData['active'];

        $user->contract_start = $validatedData['contract_start'];
        $user->contract_end = $validatedData['contract_end'];

        $user->password = bcrypt($validatedData['dni']); //No guarda nueva contraseña al actualizar si esta línea está comentada
        $user->save();

        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        if($user->user_photo != null){
            
            $file_path = public_path().'/img/'.$user->user_photo;
            
            File::delete($file_path);
        }
        
        
        $user->delete();
        


        return redirect('/user');
    }

    public function confirmDelete($id){
        return view('user.confirmDelete', ['user' => User::findOrFail($id)]);
    }

}
