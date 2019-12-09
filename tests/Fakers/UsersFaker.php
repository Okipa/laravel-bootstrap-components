<?php

namespace Okipa\LaravelBootstrapComponents\Test\Fakers;

use Hash;
use Illuminate\Support\Collection;
use Okipa\LaravelBootstrapComponents\Test\Models\User;
use Okipa\LaravelBootstrapComponents\Test\Models\UserMultilingual;

trait UsersFaker
{
    public $clearPassword;
    public $data;

    /**
     * @param int $count
     * @return Collection
     */
    public function createMultipleUsers(int $count = 5): Collection
    {
        for ($ii = 0; $ii < $count; $ii++) {
            $this->createUniqueUser();
        }

        return (new User)->all();
    }

    /**
     * @return User
     */
    public function createUniqueUser(): User
    {
        $user = (new User)->create($this->generateFakeUserData());

        return (new User)->find($user->id);
    }

    /**
     * @return array
     */
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
