<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    //test metoda
    public function testBasicTest()
    {
        $response = $this->get('/posts'); //testiramo rutu /posts

        $response->assertStatus(200);
    }
}
