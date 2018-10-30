<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            'Blogging',
            'Freelancing',
            'How to Succeed'
        ];

        App\Tag::truncate(); //obrisati SVE UNOSE tagova u bazu koje imamo

        //za svaki clan niza $values napravi po jedan tag
        foreach($values as $value)
        {
            App\Tag::create([
                'name' => $value
            ]);
        }

        App\Post::all()->each(function(App\Post $post){
            $randIds = \App\Tag::inRandomOrder()
                    ->select('id') //selektuje tagove po 'id' 
                    ->take(2) //uzima 2 random taga
                    ->pluck('id'); //pravi niz 'id' od kolona 
            $post->tags()->attach($randIds); //za svaki post nakaci 2 random taga
        });
    }
}
