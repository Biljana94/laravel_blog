<?php

namespace App;

use App\User; //povezali smo se sa User.php
use App\Comment; //povezali smo se sa Comment.php
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //veze automatski klasu Post sa tabelom post (class Post extends Model)


    //niz u koji definisemo ono sto smo uneli u bazu(samo title i body, id je autoincrement, a imamo timestamp za created i updated_at)
    protected $guarded = ['id'];


    const VALIDATION_RULES = [ //VALIDACIJA ZA POSTOVE ASOC NIZ
        'title' => 'required',
        'body' => 'required | min:25',
        'published' => 'required'
    ];


    public static function getPublishedPosts()
    {
        return Post::where('published', true)->get();//staticka funkcija, vracamo samo one postove koji su published
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id'); //ovaj post pripada autor_id
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);//jedan post moze da ima vise komentara
    }

    //ista metoda kao iz Tag.php(samo se tamo zove posts())
    public function tags()
    {
        return $this->belongsToMany(Tag::class); //ne moramo da use App\Post jer su u istom namespace-u (folderu)
    }
}
