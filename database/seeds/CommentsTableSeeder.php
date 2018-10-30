<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //za svaki post kreiramo 10 komentara
        App\Post::all()->each(function(App\Post $post) {
            $post->comments()->saveMany(factory(App\Comment::class, 10)->make());
        });
    }
}
