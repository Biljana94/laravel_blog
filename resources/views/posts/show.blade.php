@extends('layouts.master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <h2>
        <a href="/posts">
            All posts
        </a>
    </h2>

    <div class="blog-post">
        <h2 class="blog-post-title">
            {{ $post->title }}
        </h2>
        <p>{{ $post->body }}</p>

        @if(count($post->comments)) <!--ako ima komentara-->
            <h4>Comments: </h4>
            <ul class="list-unstyled">
                @foreach($post->comments as $comment)
                    <li>
                        <p><strong>Author: </strong>{{ $comment->author }}</p> <!--ispisi autora komentara-->
                        <p>{{ $comment->text }}</p> <!--ispisi text komentara-->

                        <!--forma za button za delete comment-->
                        <!-- POST metoda, koristimo je za DELETE -->
                        <form method="POST" action="/posts/{{ $post->id }}/comments/{{ $comment->id }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Delete comment</button>
                        </form>
                    </li>
                @endforeach

                

            </ul>
        @endif

        <!--forma za komentare-->
        <h4>Post a Comment</h4>
        <form method="POST" action="/posts/{{ $post->id }}/comments">

            {{ csrf_field() }}

            <div class="form-group">
                <label>Author</label>
                <!--u name:author validiramo ono iz baze, tj polje iz baze podataka-->
                <input name="author" type="text" class="form-control" placeholder="Enter author">
                @include('layouts.partials.error-message', ['field' => 'author']) <!--definisali smo $field za error-->
            </div>

            <div class="form-group">
                <label>Text</label>
                <textarea name="text" type="text" class="form-control" placeholder="Enter text"></textarea>
                @include('layouts.partials.error-message', ['field' => 'text']) <!--ovde smo definisali $field za error-->
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div><!-- /.blog-post -->
@endsection
