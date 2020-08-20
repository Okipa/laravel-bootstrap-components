<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Fakers;

use Illuminate\Support\Collection;
use Okipa\LaravelBootstrapComponents\Tests\Models\Company;

trait CompaniesFaker
{
    public function createUniqueCompany(): Company
    {
        return app(Company::class)->create($this->generateFakeCompanyData());
    }

    public function createMultipleCompanies(int $count): Collection
    {
        for ($ii = 0; $ii < $count; $ii++) {
            $this->createUniqueCompany();
        }

        return app(Company::class)->all();
    }

    public function generateFakeCompanyData(): array
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
