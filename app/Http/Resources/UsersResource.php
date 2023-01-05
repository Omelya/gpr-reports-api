<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'users',
            'attributes' => [
                'username' => $this->username,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'father_name' => $this->father_name,
                'birthday' => $this->birthday,
                'position' => $this->position,
                'rank' => $this->rank,
                'role' => $this->role,
                'online' => $this->online
            ]
        ];
    }
}
