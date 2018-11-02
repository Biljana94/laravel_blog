<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    public function testIndexValid()
    {
        $response = $this->get('/posts'); //get() pravi http request za rutu koju mi trazimo
        $response->assertStatus(200); //proveri da li je status ovog $response 200
    }

    //testiramo rutu za ulogovanog usera za create posts
    public function testCreateValid()
    {
        $user = factory(User::class)->create(); //za create rutu nam je potreban ulogovan korisnik, pa pravimo novog usera ovom linijom koda
        $response = $this->actingAs($user)->get('/posts/create'); //get pravi http request za rutu koju trazimo, i ponasaj se kao $user kojeg smo kreirali u bazi(actingAs($user))
        $response->assertStatus(200); //proveri da li je status ovog $response 200
    }

    //invalid case
    public function testCreateInvalid()
    {
        $response = $this->get('/posts/create'); //pogodi ovu rutu bez usera
        $response->assertStatus(302); //i ocekujem 302 error
    }

    //valid test
    public function testShowValid()
    {
        $user = factory(User::class)->create(); //kreirali smo usera preko factory
        $post = factory(Post::class)->create(['author_id' => $user->id]); //kreirali smo post preko factory i dodelili ga nekom useru
        $response = $this->actingAs($user)->get('/posts/' . $post->id); //ovde moramo da pisemo rutu bas kako izgleda, kod nas je ruta /posts/{id}
        $response->assertStatus(200);
    }

    //invalid test
    public function testShowInvalid()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['author_id' => $user->id]);
        $response = $this->get('/posts/' . $post->id);
        $response->assertStatus(302);
    }
}
