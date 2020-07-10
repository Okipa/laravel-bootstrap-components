# Changelog

## [2.2.0](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.12...2.2.0)

2020-07-10

* Added the possibility to use a closure as argument for the `prepend` and `append` methods of the [multilingual components](docs/api/types.md#multilingualabstract), in order to translate rendered prepended or appended HTML.

## [2.1.12](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.11...2.1.12)

2020-07-07

* Fixed wrong error message formatting for multilingual components when an input name contains several words.
  * Eg. with a `last_name` input name => The error `The last name.en field is required.` will now display like following: `The Last name (EN) field is required.` (supposing you have translated the `last_name` field in the `validation.attributes`).

## [2.1.11](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.10...2.1.11)

2020-06-08

* Fixed wrong behaviour for temporal components (date, time, datetime), for which the current date was set when the value was equal to null, zero or empty string.

## [2.1.10](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.9...2.1.10)

2020-06-08

* Rules have been softened for the form component name attribute definition : the name attribute is not automatically kebab cased anymore in order to give more usage flexibility.
  * Please note that the default id of the form components, which is automatically generated from the name attribute, is still formatted in kebab case.

## [2.1.9](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.8...2.1.9)

2020-05-25

* Fixed the `Select` component old value analysis: the select value compared against the old one is now being converted to string during the process in order to get a correct comparison with values transmitted from the HTTP request (which are always strings).

## [2.1.8](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.7...2.1.8)

2020-05-15

* Fixed `inputDatetime` component default format from `Y-m-d H:i:s` to `Y-m-d\TH:i`
  * now fits with the HTML `datetime-local` awaited format to display the value.
  * provides a better fit for most of the use cases (seconds are often not being used).
* Fixed missing translator for default captions.  

## [2.1.7](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.6...2.1.7)

2020-04-02

* Fixed the form components pre-filling when defining an array name (eg. `name[0]`).
* Fixed the placeholder generation when defining an array name (eg. `name[0]`).

## [2.1.6](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.5...2.1.6)

2020-04-02

* Fixed a bug preventing the form components to display errors on input with array name (eg. `name[0]`).
* Fixed a wrong default id generation for the for the form components on inputs with array name (`text-name0` will now be correctly displayed `text-name-0`).

## [2.1.5](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.4...2.1.5)

2020-04-01

* Small adjustments for previous release.

## [2.1.4](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.3...2.1.4)

2020-04-01

* Input file component : added an id based on the component id to make easier the css and js targeting.

## [2.1.3](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.2...2.1.3)

2020-03-19

* Fixed a form components behavior issue when some zero, null or empty strings values were provided.

## [2.1.2](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.1...2.1.2)

2020-03-03

* Added testing files to .gitattributes export-ignore.

## [2.1.1](https://github.com/Okipa/laravel-bootstrap-components/compare/2.1.0...2.1.1)

2020-02-28

* Removed wrong left margin on toggle component.

## [2.1.0](https://github.com/Okipa/laravel-bootstrap-components/compare/2.0.0...2.1.0)

2020-02-26

* Added capacity for select component to disable options.

## [2.0.0](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.10...2.0.0)

2019-12-09

* Added new components exposition.
* Removed validation status helper.
* Removed the validation sentence in case of correctly filled field.
* Restructured configuration file.
* Removed translation files.
* Updated templates.
* Added new multilingual features.
* Added new components.
* Added php7.4 support.
* Added Laravel 7 support.

:point_right: [See the upgrade guide](/docs/upgrade-guides/from-v1-to-v2.md)

## [1.0.10](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.9...1.0.10)

2019-11-26

* Changed signature of `->displaySuccess()` form components to `public function displaySuccess(?bool $displaySuccess = true): self`.
* Changed signature of `->displayFailure()` form components to `public function displayFailure(?bool $displayFailure = true): self`.
* Calling `->displaySuccess()` does not have an incidence on the `is-valid` class application : if set to false, the `is-valid` class will not be added even if the form is in success.
* Calling `->displayFailure()` does not have an incidence on the `is-invalid` class application : if set to false, the `is-invalid` class will not be added even if the form is in failure.

## [1.0.9](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.8...1.0.9)

2019-10-22

* Form components error message can now display HTML.

## [1.0.8](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.7...1.0.8)

2019-10-15

* Fixed the translations publication and overriding as specified on the Laravel documentation : https://laravel.com/docs/packages#translations.
* Changed the command to publish the translations to : `php artisan vendor:publish --tag=bootstrap-components:translations`
* Changed the command to publish the configuration to : `php artisan vendor:publish --tag=bootstrap-components:config`
* Changed the command to publish the views to : `php artisan vendor:publish --tag=bootstrap-components:views`
* Improved testing with Travis CI (added some tests with `--prefer-lowest` composer tag to check the package compatibility with the lowest dependencies versions).

## [1.0.7](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.6...1.0.7)

2019-10-08

* Improved static analysis by updating return types and PHPDocs.
* Transferred PhpUnit builds tasks from Scrutinizer to Travis CI.
* Transferred code coverage storage from Scrutinizer to Coveralls.
* Re-authorized PHP7.1 as minimal version.

## [1.0.6](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.5...1.0.6)

2019-10-03

* Fixed missing translation for titles on buttons components.

## [1.0.5](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.4...1.0.5)

2019-09-10

* Fixed missing default remove-checkbox-label-translation.

## [1.0.4](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.3...1.0.4)

2019-09-05

* Fixed wrong use of https://github.com/Okipa/laravel-html-helper. Tests added to avoid regression.

## [1.0.3](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.2...1.0.3)

2019-09-05

* Fixed missing `bootstrap-components::` prefix for default config translations.

## [1.0.2](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.1...1.0.2)

2019-09-05

* Fixed missing labels, legends and placeholders translations on components.
* Added some tests to avoid regression issues about translated label, legends and placeholders.

## [1.0.1](https://github.com/Okipa/laravel-bootstrap-components/compare/1.0.0...1.0.1)

2019-09-05

* Fixed wrong label and legend translation process.

## [1.0.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/1.0.0)

2019-09-04

* First stable release.
