<?php

namespace App\Providers;

use App\Tag;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //registracija view komposera, kad mi ucitas view, ucitaj mi i ovu relaciju
        //prvi parametar je view a dgugi niz je callback funkcija
        //moze da bude i vise
        view()->composer('layouts.master', function($view) { //ovde koristimo layouts.master jer nam je on svuda ekstendovan i svuda nam je vidljiv svuda
            $tags = Tag::has('posts')->get(); //posts je relacija
                        //vrati mi tag koji je na nekom postu
                        //has nam proverava da li ima relaciju i ako ima onda mi daj sve koje ima
            $view->with('tags', $tags); //viewu prosledjujemo tagove
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
