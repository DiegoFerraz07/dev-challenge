<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $token = $this['token'];
        $user = $this['user'];
        return array(
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        );
    }
}
