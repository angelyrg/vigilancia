<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;



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
        ]);

        $user = new User;
        
        $user->name = $validatedData['name'];
        $user->lastname = $validatedData['lastname'];
        $user->dni = $validatedData['dni'];
        $user->phone = $validatedData['phone'];
        $user->role_id = $validatedData['role_id'];
        $user->password = bcrypt($validatedData['dni']);
        $user->save();
        
        
        return redirect('/user');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view('user.edit', ['user'=>User::findOrFail($id), 'roles' => Role::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'dni' => 'required|numeric|digits:8|unique:users,dni,'.$user->id,
            'phone' => 'required|numeric|digits:9',
            'role_id' => 'required|numeric|min:1|max:2',
            'active' => 'required|bool',
        ]);
        
        $user->name = $validatedData['name'];
        $user->lastname = $validatedData['lastname'];
        $user->dni = $validatedData['dni'];
        $user->phone = $validatedData['phone'];
        $user->role_id = $validatedData['role_id'];
        $user->active = $validatedData['active'];

        $user->password = bcrypt($validatedData['dni']); //No guarda nueva contraseña al actualizar el dni si está comentado
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
        $user->delete();
        return redirect('/user');
    }

    public function confirmDelete($id){
        return view('user.confirmDelete', ['user' => User::findOrFail($id)]);
    }


}
