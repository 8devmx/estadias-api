<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getAllUsers()
    {
        $users = User::all();
        return response()->json(["users" => $users]);
    }

    public function show($id)
    {
        $user = User::where('id', $id)->get();
        return response($user);
    }
    public function insertUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->telefono = $request->telefono;
        $user->save();
    }
    public function deleteUser($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(["error" => "User not found"]);
        }
        $user->delete();
        return response()->json(["data" => "User with id $id deleted successfully"]);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->telefono = $request->telefono;
        $user->save();
        return response()->json(["data" => "Se actualizó correctamente"]);
    }
}
