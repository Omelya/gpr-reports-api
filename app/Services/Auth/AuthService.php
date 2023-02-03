<?php

namespace App\Services\Auth;

use App\Entities\UserWithAccessToken;
use App\Models\User;
use App\Repositories\Users\UsersRepository;
use App\Services\Auth\DTO\AuthDTO;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AuthService
{
    public function __construct(private UsersRepository $usersRepository)
    {}

    public function auth(AuthDTO $authDTO): UserWithAccessToken
    {
        $user = $this->usersRepository->getUserByUsername($authDTO->getUsername());
        $isMismatch = Hash::check($authDTO->getPassword(), $user->password);

        if (!$isMismatch) {
            throw new BadRequestHttpException('Invalid password');
        }

        $token = $this->createToken($user);

        return new UserWithAccessToken($token, $user);
    }

    private function createToken(User $user): NewAccessToken
    {
        return $user
            ->createToken(
                'auth-token',
                ['*'],
                now()->add(new \DateInterval('P10D')
                )
            );
    }
}
