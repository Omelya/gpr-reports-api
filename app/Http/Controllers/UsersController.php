<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\UsersWithAccessTokenResource;
use App\Http\Resources\UsersResource;
use App\Http\Transformers\Auth\AuthTransformer;
use App\Http\Transformers\Users\UsersTransformer;
use App\Repositories\Users\UsersRepository;
use App\Http\Requests\UsersRequest;
use App\Services\Auth\AuthService;

class UsersController extends Controller
{
    public function create(
        UsersRequest $usersRequest,
        UsersTransformer $usersTransformer,
        UsersRepository $usersRepository
    ): UsersWithAccessTokenResource {
        $usersDTO = $usersTransformer->transform($usersRequest);
        $users = $usersRepository->create($usersDTO);

        return new UsersWithAccessTokenResource($users);
    }

    public function auth(
        AuthRequest $authRequest,
        AuthTransformer $authTransformer,
        AuthService $authService
    )
    {
        $authDTO = $authTransformer->transform($authRequest);
        $userWithToken = $authService->auth($authDTO);

        return new UsersWithAccessTokenResource($userWithToken);
    }

    public function get(): UsersResource
    {
        return new UsersResource(auth()->user());
    }
}
