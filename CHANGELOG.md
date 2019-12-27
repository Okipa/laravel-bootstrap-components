# Changelog

## [2.0.0](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.10...2.0.0)

2019-12-09

- New internal architecture to facilitate maintenance.
- New multilingual components.
- Updated usage : components are now exposed by helpers and facades.
- Simplified configuration file.
- Simplified the way to customize components.
- Added missing button components.

:point_right: [Check all changes](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.10...2.0.0)

## [1.0.10](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.9...1.0.10)

2019-11-26

- Changed signature of `->displaySuccess()` form components to `public function displaySuccess(?bool $displaySuccess = true): self`.
- Changed signature of `->displayFailure()` form components to `public function displayFailure(?bool $displayFailure = true): self`.
- Calling `->displaySuccess()` does not have an incidence on the `is-valid` class application : if set to false, the `is-valid` class will not be added even if the form is in success.
- Calling `->displayFailure()` does not have an incidence on the `is-invalid` class application : if set to false, the `is-invalid` class will not be added even if the form is in failure.

## [1.0.9](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.8...1.0.9)

2019-10-22

- Form components error message can now display HTML.

## [1.0.8](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.7...1.0.8)

2019-10-15

- Fixed the translations publication and overriding as specified on the Laravel documentation : https://laravel.com/docs/packages#translations.
- Changed the command to publish the translations to : `php artisan vendor:publish --tag=bootstrap-components:translations`
- Changed the command to publish the configuration to : `php artisan vendor:publish --tag=bootstrap-components:config`
- Changed the command to publish the views to : `php artisan vendor:publish --tag=bootstrap-components:views`
- Improved testing with Travis CI (added some tests with `--prefer-lowest` composer tag to check the package compatibility with the lowest dependencies versions).

## [1.0.7](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.6...1.0.7)

2019-10-08

- Improved static analysis by updating return types and PHPDocs.
- Transferred PhpUnit builds tasks from Scrutinizer to Travis CI.
- Transferred code coverage storage from Scrutinizer to Coveralls.
- Re-authorized PHP7.1 as minimal version.

## [1.0.6](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.5...1.0.6)

2019-10-03

- Fixed missing translation for titles on buttons components.

## [1.0.5](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.4...1.0.5)

2019-09-10

- Fixed missing default remove-checkbox-label-translation.

## [1.0.4](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.3...1.0.4)

2019-09-05

- Fixed wrong use of https://github.com/Okipa/laravel-html-helper. Tests added to avoid regression.

## [1.0.3](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.2...1.0.3)

2019-09-05

- Fixed missing `bootstrap-components::` prefix for default config translations.

## [1.0.2](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.1...1.0.2)

2019-09-05

- Fixed missing labels, legends and placeholders translations on components.
- Added some tests to avoid regression issues about translated label, legends and placeholders.

## [1.0.1](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.0...1.0.1)

2019-09-05

- Fixed wrong label and legend translation process.

## [1.0.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.0)

2019-09-04

- First stable release.
