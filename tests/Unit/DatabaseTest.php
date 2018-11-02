<?php

namespace Tests\Unit;

use App\User;
use App\Post;
use App\Comment;
use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    //testiramo database Posts Table, nakon sto kreiramo post da li je on stvarno kreiran u bazi
    public function testPostsTableValid()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);

        $this->assertDatabaseHas('posts', ['title' => $post->title]); //proveravamo da li ima post sa tim titlom(naslovom)
    }

    //test za komentare, da li su komentari uneti u bazu nakon kreiranja
    public function testCommentsTableValid()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);
        $post->comments()->saveMany(factory(Comment::class, 10)->make()); //kreiramo vise komentara, koristimo make() zato sto kreiramo vise komentara

        $this->assertEquals(10, $post->comments()->count()); //proveravamo da li je napravljeno 10 komentara
                    //brojimo broj redova u bazi, a da su stvarno ispisani
    }

    //kad kreiramo tagove da li su oni stvarno upisani u bazu i na postu
    public function testTagsOnPostTableValid()
    {
        $user = factory(User::class)->create(); //kreirali smo usera
        $post = factory(Post::class)->create(['author_id' => $user->id]); //kreirali smo post
        //$tag = factory(Tag::class)->create(); //ovde kreiramo samo 1 tag pa nam ovo ne treba, jer ispod kreiramo 10 tagova, linija koda koja je odma ispod ove

        $post->tags()->saveMany(factory(Tag::class, 10)->make()); //kreiramo 10 tagova pomocu factory, gledati u TagFactory.php zbog imena tabele

        $this->assertEquals(10, $post->tags()->count()); //prebrojavamo tih 10 tagova da li su kreirani i uneti u bazu
    }

    //da li mi je kreiran tag u tabeli sa tim imenom
    public function testTagsTableValid()
    {
        $tag = factory(Tag::class)->create(); //kreiramo jedan tag
        $this->assertDatabaseHas('tags', ['name' => $tag->name]); //da li je tag sa tim imenom kreiran u bazi
    }
}
