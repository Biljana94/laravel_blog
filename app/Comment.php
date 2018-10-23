<?php

namespace App;

use App\Post;//povezemo se sa post modelom
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];//samo polja koja necemo da menjamo nikad

    const VALIDATION_RULES = [ //KONSTANTA KOJA NAM CUVA VALIDACIJU PODATAKA
        'author' => 'required | max:15 | string',
        'text' => 'required | min:25'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class); //komentar pripada postu(jedan komentar pripada jednom postu)
    }
}
