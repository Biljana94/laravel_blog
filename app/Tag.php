<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    //ista metoda ima u Post.php samo se zove posts()
    public function posts()
    {
        return $this->belongsToMany(Post::class); //ne moramo da use App\Post jer su u istom namespace-u (folderu)
    }

    //ova metoda na elokvent modelu i mi smo je override
    public function getRouteKeyName()
    {
        return 'name'; //preko kolone koju mi zelimo povezujemo rutu sa kontrolerom
    }
}
