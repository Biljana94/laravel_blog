<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts() //za taj tag dovuci mi sve postove
            ->with('author') //sa autorom
            ->latest() //i najnovije postove prvo prikazi
            ->paginate(10); //po stranici prikazi 10 postova

        return view('posts.index')->with('posts', $posts); //kad se klikne na tag da izbaci sve postove koji imaju taj tag
    }
}
