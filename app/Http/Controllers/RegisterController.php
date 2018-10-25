<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $this->validate(
            request(),
            User::VALIDATION_RULES//validaciona pravila koja su definisana u User.php
        );

        $user = User::create(request()->all());//ovde kreiramo usera
        auth()->login($user);//ovo ce nas ulogovati u aplikaciju (ne moze niz jer ne moze da se autentifikuje)
        return redirect('/posts');//i redirektuje nas na stranicu /posts
    }
}
