<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user(): void
    {
        $firstName = $this->faker()->firstName;
        $lastName = $this->faker()->lastName;
        $fatherName = $this->faker()->title;
        $username = $this->faker()->unique()->email();
        $randomWord = $this->faker()->word;

        $data = [
            'data' => [
                'type' => 'users',
                'attributes' => [
                    'username' => $username,
                    'password' => 'randomPass1234',
                    'password_confirmation' => 'randomPass1234',
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'father_name' => $fatherName,
                    'birthday' => '2000-01-01',
                    'rank' => $randomWord,
                    'position' => $randomWord
                ]
            ]
        ];

        $response = $this->postJson('/api/user/create', $data);

        $response->assertOk()
            ->assertJson(
                [
                    'data' => [
                        'type' => 'users',
                        'attributes' => [
                            'user' => [
                                'username' => $username,
                                'first_name' => $firstName,
                                'last_name' => $lastName,
                                'father_name' => $fatherName,
                                'rank' => $randomWord,
                                'position' => $randomWord,
                            ]
                        ]
                    ]
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_user(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson('/api/user');

        $response->assertOk()
            ->assertJson(
                [
                    'data' => [
                        'id' => $user->id,
                        'type' => 'users',
                        'attributes' => [
                            'username' => $user->username,
                            'first_name' => $user->first_name,
                            'last_name' => $user->last_name,
                            'father_name' => $user->father_name,
                            'rank' => $user->rank,
                            'position' => $user->position,
                        ]
                    ]
                ]
            );
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_user_without_auth(): void
    {
        User::factory()->create();

        $response = $this->getJson('/api/user');

        $response->assertUnauthorized();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login(): void
    {
        $user = User::factory()->create();

        $data = [
            'data' => [
                'type' => 'users',
                'attributes' => [
                    'username' => $user->username,
                    'password' => 'password'
                ]
            ]
        ];

        $response = $this->postJson('/api/login', $data);

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    'type',
                    'attributes' => [
                        'user' => [
                            'username',
                            'first_name',
                            'last_name',
                            'father_name',
                            'rank',
                            'position'
                        ],
                        'token' => [
                            'access_token',
                            'expires_at'
                        ]
                    ]
                ]
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user_with_same_username(): void
    {
        $user = User::factory()->create();

        $data = [
            'data' => [
                'type' => 'users',
                'attributes' => [
                    'username' => $user->username,
                    'password' => 'randomPass1234',
                    'password_confirmation' => 'randomPass1234',
                    'first_name' => $this->faker()->firstName,
                    'last_name' => $this->faker()->lastName,
                    'father_name' => $this->faker()->name,
                    'birthday' => '2000-01-01',
                    'rank' => $this->faker()->word,
                    'position' => $this->faker()->word
                ]
            ]
        ];

        $response = $this->postJson('/api/user/create', $data);

        $response->assertStatus(422);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_user_with_incorrect_data(): void
    {
        $firstName = 12;
        $lastName = $this->faker()->lastName;
        $fatherName = $this->faker()->title;
        $username = 'username';
        $randomWord = $this->faker()->word;

        $data = [
            'data' => [
                'type' => 'users',
                'attributes' => [
                    'username' => $username,
                    'password' => 'ra',
                    'password_confirmation' => 'rand',
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'father_name' => $fatherName,
                    'birthday' => '2000-01-01',
                    'rank' => $randomWord,
                    'position' => $randomWord
                ]
            ]
        ];

        $response = $this->postJson('/api/user/create', $data);

        $response->assertStatus(422);
    }
}
