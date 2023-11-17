<?php

namespace App\Models;

use App\Http\Requests\Users\UsersAddFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function fillUsers(UsersAddFormRequest $request): Users
    {
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = $request->password;
        return $this;
    }
}
