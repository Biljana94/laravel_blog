<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //za svakog usera kreiraj mi toliko postova (po 5 postova za svakog usera)
        //each() prihvata callback fnc i u njoj kao parametar pisemo model User
        App\User::all()->each(function(App\User $user) {
            $user->posts()->saveMany(factory(App\Post::class, 5)->make());
        });
    }
}
