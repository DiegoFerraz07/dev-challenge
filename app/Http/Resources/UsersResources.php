<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $saved = $this['saved'];
        return array(
            'success' => $saved['success'],
            'message' => $saved['message'],
            'access_token' => $saved['token'],
            'token_type' => 'Bearer'
        );
    }
}
