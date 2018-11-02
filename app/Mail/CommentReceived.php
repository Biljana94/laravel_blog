<?php

namespace App\Mail;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $post; //nova varijabla koju smo definisali

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post; //dodelili smo vrednost $post varijabli

        //dd($this->post);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('posts.comment_received'); //saljemo mail sa sadrzajem iz foldera posts iz fajla comment_received.blade.php
    }
}
