<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class UsersWithAccessTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'type' => 'users',
            'attributes' => [
                'user' => [
                    'username' => $this->getUser()->username,
                    'first_name' => $this->getUser()->first_name,
                    'last_name' => $this->getUser()->last_name,
                    'father_name' => $this->getUser()->father_name,
                    'birthday' => $this->getUser()->birthday,
                    'position' => $this->getUser()->position,
                    'rank' => $this->getUser()->rank,
                    'role' => $this->getUser()->role,
                    'online' => $this->getUser()->online,
                ],
                'token' => [
                    'access_token' => $this->getAccessToken()->plainTextToken,
                    'expires_at' => $this->getAccessToken()->accessToken->expires_at
                ]
            ]
        ];
    }
}
