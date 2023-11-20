<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Requests\PostAddFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Post extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['comments','user_id'];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function fillPost(PostAddFormRequest $request): Post
    {
        $this->comments = $request->comments;
        $this->user_id = auth('sanctum')->user()->id;
        return $this;
    }
}
