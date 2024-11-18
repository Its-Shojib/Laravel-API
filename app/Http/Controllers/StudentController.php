<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class StudentController extends Controller
{
    function getUser(){
        return Users::all();
    }
}
