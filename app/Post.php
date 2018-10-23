<?php

namespace App;

use App\Comment; //povezali smo se sa Comment.php
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //veze automatski klasu Post sa tabelom post (class Post extends Model)


    //niz u koji definisemo ono sto smo uneli u bazu(samo title i body, id je autoincrement, a imamo timestamp za created i updated_at)
    protected $fillable = [
        'title', 'body' , 'published'
    ];

    public static function getPublishedPosts()
    {
        return Post::where('published', true)->get();//staticka funkcija, vracamo samo one postove koji su published
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);//jedan post moze da ima vise komentara
    }
}
