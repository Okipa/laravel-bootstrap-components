# Changelog

## [0.5.0](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.5.0)
2018-09-26
- Fixed the `->componentId()` method call for form components, which didn't update the associated label `for=""` tag content.

## [0.4.9](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.4.9)
2018-09-12
- Setting a custom label has does now also replace the default placeholder. If a custom placeholder is also set, this custom placeholder will be shown instead of the custom label.

## [0.4.8](https://github.com/Okipa/laravel-bootstrap-components/releases/tag/0.4.8)
2018-09-11
- Added possibility to set custom ids with the methods `containerId()` and `->componentId()` for all components :
  - Form components, which have a default id, will have it replaced by the custom defined id.
  - Other components that have no default id will have no id, unless you define it.
