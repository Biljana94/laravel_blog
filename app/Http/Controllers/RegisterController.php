<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest'); //sve rute koje hendla ovaj kontroler mora proci kroz ovaj middleware
    }

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

        $user = new User();//instanca modela User.php
        $user->name = request('name');//ime usera
        $user->email = request('email');//email usera
        $user->password = bcrypt(request('password'));//pass usera
        $user->save();//nas objekat usera cuva u bazi

        // $user = User::create(request()->all());//ovde kreiramo usera
        auth()->login($user);//ovo ce nas ulogovati u aplikaciju (ne moze niz jer ne moze da se autentifikuje) - auth()
        return redirect('/posts');//i redirektuje nas na stranicu /posts
    }
}
