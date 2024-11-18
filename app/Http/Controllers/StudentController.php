<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    function getUser()
    {
        return Users::all();
    }


    function createUser(Request $request)
    {
        $rules = array(
            'name' => 'required|string|max:50|min:3',
            'email' => 'required|string|email|max:255',
            'age' => 'required|integer',
            'phone' => 'required|string|min:11|max:11'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->failed()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->age = $request->age;
        $user->phone = $request->phone;
        $user->save();

        return response()->json(['message' => 'User created successfully'], 201);
    }

    //Update student
    function updateUser(Request $request, $id)
    {
        $user = Users::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->age = request('age');
        $user->phone = request('phone');
        $user->save();

        return response()->json(['message' => 'User updated successfully'], 200);
    }

    //Delete student
    function deleteUser($id)
    {
        $user = Users::find($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }

    //Get student by name
    function searchUserByName($name)
    {
        return Users::where('name', 'LIKE', '%' . $name . '%')->get();
    }

    //login user
    function loginUser(Request $request)
    {
        $rules = array(
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|max:255'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->failed()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = Users::where('email', $request->email)->first();

        if ($user && $user->password == $request->password) {
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['message' => 'User authenticated successfully', 'token' => $token]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
