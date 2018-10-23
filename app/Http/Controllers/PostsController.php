<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::getPublishedPosts();//selektujemo samo one postove koji su uneti na stranici posts/create i koji su cekirani na published
        return view('posts.index', ['posts' => $posts]);//vracamo view na stranici gde nam se prikazuju uneti postovi, koristimo index.blade.php fajl
    }

    public function show($id)//trazimo knjigu po id
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);//prikazujemo 1 post na stranici
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //validacija podataka, pomocu ovih pravila ubacuje nam u create.blade.php (validirali smo greske koje mogu da se dese)
        $this->validate(
            request(),
            [
                'title' => 'required',
                'body' => 'required | min:25',
                'published' => 'required'
            ] 
        );

        Post::create(request()->all());//spusta u bazu jos jedan novi post sa podacima iz forme
        return redirect('/posts');
    }
}
