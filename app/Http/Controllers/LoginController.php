<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function logout()
    {
        auth()->logout();//izlogovacemo usera
        return redirect('/posts');//redirektuje nas na stranicu /posts
    }
}
