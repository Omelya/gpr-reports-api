<?php

namespace App\Http\Controllers;

use App\Http\Resources\UsersAccessTokenResource;
use App\Http\Resources\UsersResource;
use App\Http\Transformers\Users\UsersTransformer;
use App\Repositories\Users\UsersRepository;
use App\Http\Requests\UsersRequest;
use Illuminate\Http\Client\Response;

class UsersController extends Controller
{
    public function create(
        UsersRequest $usersRequest,
        UsersTransformer $usersTransformer,
        UsersRepository $usersRepository
    ) {
        $usersDTO = $usersTransformer->transform($usersRequest);
        $users = $usersRepository->create($usersDTO);

        return new UsersAccessTokenResource($users);
    }

    public function get(): UsersResource
    {
        return new UsersResource(auth()->user());
    }
}
