<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class StudentController extends Controller
{
    function getUser(){
        return Users::all();
    }

    function createUser(Request $request){
        $user = new Users();
        $user->name = request('name');
        $user->email = request('email');
        $user->age = request('age');
        $user->phone = request('phone');
        $user->save();

        return response()->json(['message' => 'User created successfully'], 201);

    }

    //Update student
    function updateUser(Request $request, $id){
        $user = Users::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->age = request('age');
        $user->phone = request('phone');
        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }
}
