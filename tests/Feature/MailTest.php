<?php

namespace Tests\Feature;

use App\Post; //
use App\User; //
//use App\Comment; //
use Illuminate\Support\Facades\Mail; //use Mail fasadu
use App\Mail\CommentReceived; //moramo i commentReceived da use-ujemo
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MailTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    //validan slucaj za mail, testiramo da li je mail poslat nakon komentarisanja posta
    public function testCommentReceivedValid()
    {
        $user = factory(User::class)->create(); //kreirali smo usera
        $post = factory(Post::class)->create(['author_id' => $user->id]); //kreirali smo post

        //dd($post);

        Mail::fake(); //fake() nam pravi lazni email, MOKOVANJE

        $this->actingAs($user)->post('/posts/' . $post->id . '/comments', ['text' => 'this is some text bla bla', 'author' => 'Author']);
                        //autor ne sme da ima razmak i vise od 10 slova, a text mora imati minimum 15 karaktera, GLEDAMO VALIDACIONA PRAVILA I COMMENT.PHP MODELA

        //proveri mi da li je poslat Commentreceived Mail na kojem je $post->id isti kao onaj koji smo naveli
        //prvi parametar je ime nase klase a drugi je callback funckija sta zelimo tacno da assertujemo-proverimo
        Mail::assertSent(CommentReceived::class, function($mail) use($post) {
            return $mail->post->id === $post->id; //$mail->post->id je isti kao onaj u CommentReceived.php 
        });
    }

    //invalid case, comment not received
    //isto kao ono gore al samo izostavimo nesto da bude pogresno
    public function testCommentReceivedInvalid()
    {
        $user = factory(User::class)->create(); //kreirali smo usera
        $post = factory(Post::class)->create(['author_id' => $user->id]); //kreirali smo post

        Mail::fake(); //MOKOVANJE

        $this->actingAs($user)->post('/posts/' . $post->id . '/comments', ['text' => 'this is some text bla bla']);

        Mail::assertNotSent(CommentReceived::class, function($mail) use($post) {
            return $mail->post->id === $post->id;
        });
    }

     //testiramo kada nije validan mejl - MILICIN TEST
    // public function testCommentReceivedInvalid()
    // {
    //     $user = factory(User::class)->create();
    //     $post = factory(Post::class)->create(['author_id' => $user->id]);

    //     Mail::fake();

    //     $this->post('/posts' . $post->id . '/comments', //pisemo sve isto samo izbacimo nesto da ne bude validan mejl
    //     ['text' => 'this is some text add more', 
    //     'author' => 'somename']
    //     );

    //     Mail::assertNotSent(CommentReceived::class, function($mail) use ($post){
    //         return $mail->post->id === $post->id;
    //     });
    // }
}
