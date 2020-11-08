<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Fakers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Okipa\LaravelBootstrapComponents\Tests\Models\User;

trait UsersFaker
{
    public string $clearPassword;

    public array $data;

    public function createMultipleUsers(int $count = 5): Collection
    {
        for ($ii = 0; $ii < $count; $ii++) {
            $this->createUniqueUser();
        }

        return (new User())->all();
    }

    public function createUniqueUser(): User
    {
        $user = (new User())->create($this->generateFakeUserData());

        return (new User())->find($user->id);
    }

    public function generateFakeUserData(): array
    {
        $this->clearPassword = $this->faker->word;

        return [
            'name' => $this->faker->word,
            'email' => $this->faker->email,
            'password' => Hash::make($this->clearPassword),
            'credit' => 50,
            'active' => true,
        ];
    }
}
