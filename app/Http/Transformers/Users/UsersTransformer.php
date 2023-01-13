<?php

namespace App\Http\Transformers\Users;

use Illuminate\Http\Request;
use App\Services\Users\DTO\UsersDTO;
class UsersTransformer
{
    public function transform(Request $request): UsersDTO
    {
        return new UsersDTO(
            $request->json('data.attributes.username'),
            $request->json('data.attributes.password'),
            $request->json('data.attributes.first_name'),
            $request->json('data.attributes.last_name'),
            $request->json('data.attributes.father_name'),
            $request->json('data.attributes.birthday'),
            $request->json('data.attributes.position'),
            $request->json('data.attributes.rank')
        );
    }
}
