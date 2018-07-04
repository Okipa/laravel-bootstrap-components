<?php

namespace Okipa\LaravelBootstrapComponents\Test\Fakers;

use Okipa\LaravelBootstrapComponents\Test\Models\Company;

trait CompaniesFaker
{
    public function createUniqueCompany()
    {
        return app(Company::class)->create($this->generateFakeCompanyData());
    }

    public function createMultipleCompanies(int $count)
    {
        for ($ii = 0; $ii < $count; $ii++) {
            $this->createUniqueCompany();
        }

        return app(Company::class)->all();
    }

    public function generateFakeCompanyData()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
