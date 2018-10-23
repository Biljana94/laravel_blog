<?php

namespace App;

use App\Post;//povezemo se sa post modelom
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];//samo polja koja necemo da menjamo nikad

    public function post()
    {
        return $this->belongsTo(Post::class); //komentar pripada postu(jedan komentar pripada jednom postu)
    }
}
