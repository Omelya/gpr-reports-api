<?php

namespace App\Http\Transformers\Auth;

use App\Services\Auth\DTO\AuthDTO;
use Illuminate\Http\Request;

class AuthTransformer
{
    public function transform(Request $request): AuthDTO
    {
        return new AuthDTO(
            $request->input('data.attributes.username'),
            $request->input('data.attributes.password')
        );
    }
}
