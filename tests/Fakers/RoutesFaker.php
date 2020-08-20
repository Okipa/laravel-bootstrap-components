<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Fakers;

trait RoutesFaker
{
    public function setRoutes(array $entities = ['users'], array $routes = ['index']): void
    {
        foreach ($entities as $entity) {
            foreach ($routes as $route) {
                app('router')->get(
                    '/' . $entity . '/' . $route,
                    ['as' => $entity . '.' . $route, fn() => $entity . '.' . $route . ' route.']
                );
            }
        }
    }
}
