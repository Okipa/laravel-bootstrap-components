<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;
use RuntimeException;

abstract class TemporalTestAbstract extends InputTestAbstract
{
    abstract protected function getFormat(): string;

    /** @test */
    public function it_can_return_instance_from_extended_testing_class(): void
    {
        self::assertInstanceOf(TemporalAbstract::class, $this->getComponent());
    }

    /** @test */
    public function it_can_get_value_from_model(): void
    {
        $user = $this->createUniqueUser();
        // Datetime object
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        self::assertStringContainsString(' value="' . $user->published_at->format($this->getFormat()) . '"', $html);
        // Datetime string
        $user->published_at = $this->faker->dateTime->format($this->getFormat());
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        self::assertStringContainsString(
            ' value="' . Carbon::parse($user->published_at)->format($this->getFormat()) . '"',
            $html
        );
    }

    /** @test */
    public function it_can_set_default_format_from_component_config(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        self::assertStringContainsString($user->published_at->format('d/m/Y H-i-s'), $html);
    }

    /** @test */
    public function it_can_replace_default_format(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->format('Y-m-d')->toHtml();
        self::assertStringContainsString($user->published_at->format('Y-m-d'), $html);
        self::assertStringNotContainsString($user->published_at->format('d/m/Y H-i-s'), $html);
    }

    /** @test */
    public function it_cant_set_wrong_model_value(): void
    {
        $user = $this->createUniqueUser();
        $user->name = 'custom-name';
        $this->expectException(RuntimeException::class);
        $this->getComponent()->model($user)->name('name')->toHtml();
    }

    /** @test */
    public function it_cant_set_no_format(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->name('published_at')->format('')->toHtml();
    }

    /** @test */
    public function it_cant_set_wrong_value(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->name('name')->value('custom-value')->toHtml();
    }

    /** @test */
    public function it_can_set_value(): void
    {
        $value = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $value->format($this->getFormat()) . '"', $html);
    }

    /** @test */
    public function it_can_set_zero_value(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_empty_string_value(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_null_value(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_set_value_from_closure_with_disabled_multilingual(): void
    {
        $value = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value(function () use ($value) {
            return $value;
        })->toHtml();
        self::assertStringContainsString(' value="' . $value->format($this->getFormat()) . '"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_string(): void
    {
        $oldValue = $this->faker->dateTime->format($this->getFormat());
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => $oldValue])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $oldValue . '"', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_null(): void
    {
        $oldValue = null;
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => $oldValue])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    /** @test */
    public function it_can_take_old_value_from_array(): void
    {
        $oldValue = $this->faker->dateTime->format($this->getFormat());
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => [0 => $oldValue]])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $oldValue . '"', $html);
    }
}
