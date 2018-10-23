<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store($id)
    {
        $post = Post::findOrFail($id);

        //validacija komentara, mora ovde da se pise
        //validacija prima kao parametar funkciju request() da ne bi otislo do baze i da nam ne bi izbacivalo gresku na bazi
        //i asocijativni niz u kojem definisemo kada ce da se bacaju greske(ako ima manje karaktera od definisanih...)
        $this->validate(
            request(),
            Comment::VALIDATION_RULES //OVO JE USTVARI ASOCIJATIVNI NIZ 
        );

        $post->comments()->create(
            request()->all()
        );

        return redirect("/posts/{$id}"); //redirekcija, MORAJU BITI DUPLI NAVODNICI OVAKO AKO PISEMO
                        //ILI ('/posts/' . $id);
    }
}
