<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Mail\CommentReceived;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store($postId)
    {
        $post = Post::findOrFail($postId);

        //dd($post);

        //validacija komentara, mora ovde da se pise
        //validacija prima kao parametar funkciju request() da ne bi otislo do baze i da nam ne bi izbacivalo gresku na bazi
        //i asocijativni niz VALIDATION_RULES u kojem definisemo kada ce da se bacaju greske(ako ima manje karaktera od definisanih...)
        $this->validate(
            request(),
            Comment::VALIDATION_RULES //OVO JE USTVARI ASOCIJATIVNI NIZ iz Comment.php
        );

        $post->comments()->create(
            request()->all()
        );

        //dd($post->author->email);

        // zovemo Mail fasadu, to() funkcija kome saljemo email, poslace email autoru komentara da je email poslat
        Mail::to($post->author->email)->send(new CommentReceived($post));//u send() salje sablon tj CommentReceived i prosledjujemo na koji post smo stavili komentar, a taj $post se nalazi na CommentReceived.php

        return redirect("/posts/{$postId}"); //redirekcija, MORAJU BITI DUPLI NAVODNICI OVAKO AKO PISEMO
                        //ILI ('/posts/' . $postId);
    }

    public function destroy($postId, $commentId)
    {
        $comment = Comment::findOrFail($commentId);//nalazimo komentar po id ($commentId)
        $comment->delete();//brisanje komentara iz baze

        return redirect("/posts/{$postId}");//vraca nas na stranicu tog posta sa kojeg smo izbrisali komentar

        //dd(compact(['postId', 'commentId']));
    }
}
