<?php

namespace App;

use App\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    const VALIDATION_RULES = [ //VALIDACIJA ZA registrovanje usera
        'name' => 'required',
        'email' => 'required | email',
        'password' => 'required | min:10'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id'); //ovaj autor ima nekoliko postova(hasMany())
    }
}
