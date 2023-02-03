<?php

namespace App\Repositories\Users;

use App\Entities\UserWithAccessToken;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\Users\DTO\UsersDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UsersRepository extends BaseRepository
{
    public function create(UsersDTO $usersDTO): UserWithAccessToken
    {
        if ($this->hasUser($usersDTO->getUsername())) {
            throw new UnprocessableEntityHttpException('Username already');
        }

        $user = $this
            ->query()
            ->create([
                'username' => $usersDTO->getUsername(),
                'password' => Hash::make($usersDTO->getPassword()),
                'first_name' => $usersDTO->getFirstName(),
                'last_name' => $usersDTO->getLastName(),
                'father_name' => $usersDTO->getFatherName(),
                'birthday' => $usersDTO->getBirthday(),
                'position' => $usersDTO->getPosition(),
                'rank' => $usersDTO->getRank()
            ]);

        $expiresAt = (new \DateTime())->add(new \DateInterval('P10D'));

        $token = $user->createToken('auth-token', ['*'], $expiresAt);

        return new UserWithAccessToken($token, $user);
    }

    public function getUserByUsername(string $username): User|Builder
    {
        if (!$this->hasUser($username)) {
            throw new ModelNotFoundException('This username was not found');
        }

        return $this
            ->query()
            ->where('username', $username)
            ->first();
    }

    public function hasUser(string $username): bool
    {
        return (bool) $this
            ->query()
            ->firstWhere('username', $username);
    }

    public function getModel(): User
    {
        return new User();
    }
}
