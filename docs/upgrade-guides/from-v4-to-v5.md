# Upgrade from v4 to v5

Follow the steps below to upgrade the package.

## Method signature changes

The behaviour of the following methods have gained the ability to merge given HTML classes or HTML attributes to the component default ones instead of replacing them.

To trigger this new behaviour, you'll just have to set the second boolean `$mergeMode` attribute to `false`.

* `componentClasses`
* `containerClasses`
* `componentHtmlAttributes`
* `containerHtmlAttributes`

## See all changes

See all change with the [comparison tool](https://github.com/Okipa/laravel-bootstrap-components/compare/4.0.0...5.0.0).

## Undocumented changes

If you see any forgotten and undocumented change, please submit a PR to add them to this upgrade guide.
