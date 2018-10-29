
@extends('layouts.master') <!--ovde ukljucujemo master.blade.php u ovaj fajl-->

@section('title')
    All posts
@endsection


@section('content')
    <a href="/posts/create">
        <button type="submit" class="btn btn-primary">Create New Post</button>
    </a>

    <h1>Posts</h1>
    <ul>
        @foreach($posts as $post)
            <li>
                <div class="blog-post">
                    <h2 class="blog-post-title">
                        <a href="/posts/{{$post->id}}">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p>{{ $post->body }}</p>
                    {{-- ruta za postove jednog autora, mora users/{}, ta ruta je definisana u web.php - /users/{id} --}}
                    <p>Written by <a href="/users/{{ $post->author_id }}"> {{ $post->author->name }}</a></p> <!--napisali smo ime autora posta, metoda author() iz Post.php-->
                </div><!-- /.blog-post -->
          </li>
        @endforeach
    </ul>
@endsection
