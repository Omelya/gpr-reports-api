<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Services\Users\DTO\UsersDTO;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\NewAccessToken;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class UsersRepository extends BaseRepository
{
    public function create(UsersDTO $usersDTO): NewAccessToken
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

        return $user->createToken('auth-token', ['*'], $expiresAt);
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
