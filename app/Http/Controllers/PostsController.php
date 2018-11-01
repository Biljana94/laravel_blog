<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PostsController extends Controller
{
    public function index()
    {
        //->paginate(10); paginacija stranica, tj deljenje postova na vise stranica
        $posts = Post::getPublishedPosts()->paginate(10);//selektujemo samo one postove koji su uneti na stranici posts/create i koji su cekirani na published
        return view('posts.index', ['posts' => $posts]);//vracamo view na stranici gde nam se prikazuju uneti postovi, koristimo index.blade.php fajl
    }

    public function show($id)//trazimo knjigu po id
    {
        //nadji mi komentare i post tog $id (with(comments) -> find($id))
        $post = Post::with('comments')->findOrFail($id);//with je igr loading - odma dovlaci sve (dovuci ce i post i njegove komentare)

        //dd($post); //sluzi da proverimo da li je sve kako treba

        return view('posts.show', ['post' => $post]);//prikazujemo 1 post na stranici
    }

    public function create()
    {
        $tags = Tag::all(); //dovlacimo tagove pri kreiranju posta
        return view('posts.create')->with('tags', $tags); //eager loading, dovlacimo tagove pri kreiranju posta, i u create,blade.php ih ispisujemo u posts folderu
    }

    public function store()
    {
        //validacija mora da se pise ovde iznad requesta
        //validacija podataka, pomocu ovih pravila ubacuje nam u create.blade.php (validirali smo greske koje mogu da se dese)
        $this->validate(
            request(),
            Post::VALIDATION_RULES //OVO JE ASOC NIZ ZA VALIDACIJU KOJI SE NALAZI U Post.php 
        );


        // dd(auth()->user());

        // Post::create(
        //     array_merge(
        //         request()->all(),
        //         [
        //             'author_id' => auth()->user()->id
        //         ]
        //     )
        // );//spusta u bazu jos jedan novi post sa podacima iz forme i veze ga za autora koji je napisao taj post

        $post = new Post();
        $post->title = request('title');
        $post->body = request('body');
        $post->author_id = auth()->user()->id;
        $post->published = true;

        $post->save();

        $post->tags()->attach(request('tags')); //prosledili smo niz 'id' tagova kojih smo selektovali u $post (tagovi koje smo selektovali pri kreiranju posta)

        return redirect('/posts');
    }
}
