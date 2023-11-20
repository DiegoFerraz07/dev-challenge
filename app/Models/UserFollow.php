<?php

namespace App\Models;

use App\Http\Requests\UsersFollowFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use HasFactory;

    protected $table = 'user_follows';

    public function fillFollow(UsersFollowFormRequest $request)
    {
        $this->user_id = $request->id;
        $this->user_followed = $request->user_id_follow;
        return $this;
    }
}
