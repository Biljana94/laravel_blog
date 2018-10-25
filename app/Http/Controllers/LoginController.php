<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', [ 'except' => 'logout' ]); //proverava da li je korisnik gost, pustice dalje ; => nemoj da primenis ovaj middleware na logout
    }

    //metoda da se user izloguje
    public function logout()
    {
        auth()->logout();//izlogovacemo usera
        return redirect('/posts');//redirektuje nas na stranicu /posts
    }

    //metoda za login
    public function login()
    {
        if(!auth()->attempt(request(['email', 'password']))) { //autentifikacija usera, mora imati email i password, i ta polja uzimamo sa requesta
                                                            //proverava da li u bazi ima tog usera sa tim emailom i pass - attempt()
                                                            //ako nije prosao ovo
            return back()->withErrors([
                'message' => 'Pogresio si sifru. You shall not pass!'
            ]);//vratice stranicu sa nakacenim errorima
        }

        return redirect('/posts');//kad se uloguje redirektuje nas na stranicu /posts
    }

    //metoda za vracanje viewa
    public function index()
    {
        return view('login.index');//vracamo view iz login foldera iz index.blade.php
    }
}
