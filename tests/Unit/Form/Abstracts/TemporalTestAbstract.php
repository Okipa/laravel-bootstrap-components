<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Carbon\Carbon;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;
use RuntimeException;

abstract class TemporalTestAbstract extends InputTestAbstract
{
    public function testInstance(): void
    {
        self::assertInstanceOf(TemporalAbstract::class, $this->getComponent());
    }

    public function testModelValue(): void
    {
        $user = $this->createUniqueUser();
        // datetime object
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        self::assertStringContainsString(' value="' . $user->published_at->format($this->getFormat()) . '"', $html);
        // datetime string
        $user->published_at = $this->faker->dateTime->format($this->getFormat());
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        self::assertStringContainsString(
            ' value="' . Carbon::parse($user->published_at)->format($this->getFormat()) . '"',
            $html
        );
    }

    abstract protected function getFormat(): string;

    public function testWrongModelValue(): void
    {
        $user = $this->createUniqueUser();
        $user->name = 'custom-name';
        $this->expectException(RuntimeException::class);
        $this->getComponent()->model($user)->name('name')->toHtml();
    }

    public function testWiredDisplaysSuccessWithNoErrorWithValue(): void
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $messageBag = app(MessageBag::class)->add('other_name', 'Dummy error message.');
        $errors = app(ViewErrorBag::class)->put('default', $messageBag);
        $html = $this->getComponent()
            ->name('name')
            ->value($this->faker->dateTime)
            ->componentHtmlAttributes(['wire:model' => 'name'])
            ->render(compact('errors'));
        self::assertStringContainsString('is-valid', $html);
    }

    public function testDefaultFormat(): void
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

    public function testSetFormatReplacesDefault(): void
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

    public function testSetNoFormat(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->name('published_at')->format('')->toHtml();
    }

    public function testSetWrongValue(): void
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->name('name')->value('custom-value')->toHtml();
    }

    public function testSetValue(): void
    {
        $value = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $value->format($this->getFormat()) . '"', $html);
    }

    public function testSetZeroValue(): void
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    public function testSetEmptyStringValue(): void
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    public function testSetNullValue(): void
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        self::assertStringContainsString(' value=""', $html);
    }

    public function testSetValueFromClosureWithDisabledMultilingual(): void
    {
        $value = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value(function () use ($value) {
            return $value;
        })->toHtml();
        self::assertStringContainsString(' value="' . $value->format($this->getFormat()) . '"', $html);
    }

    public function testOldValue(): void
    {
        $oldValue = $this->faker->dateTime->format($this->getFormat());
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => $oldValue])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $oldValue . '"', $html);
        self::assertStringNotContainsString(' value="' . $value . '"', $html);
    }

    public function testOldArrayValue(): void
    {
        $oldValue = $this->faker->dateTime->format($this->getFormat());
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => fn() => request()->merge(['name' => [0 => $oldValue]])->flash(),
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value($value)->toHtml();
        self::assertStringContainsString(' value="' . $oldValue . '"', $html);
        self::assertStringNotContainsString(' value="' . $value . '"', $html);
    }
}
