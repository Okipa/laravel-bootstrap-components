<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Carbon\Carbon;
use RuntimeException;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

abstract class TemporalTestAbstract extends InputTestAbstract
{
    public function testInstance()
    {
        $this->assertInstanceOf(TemporalAbstract::class, $this->getComponent());
    }

    public function testModelValue()
    {
        $user = $this->createUniqueUser();
        // datetime object
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString(' value="' . $user->published_at->format($this->getFormat()) . '"', $html);
        // datetime string
        $user->published_at = $this->faker->dateTime->format($this->getFormat());
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString(
            ' value="' . Carbon::parse($user->published_at)->format($this->getFormat()) . '"',
            $html
        );
    }

    abstract protected function getFormat(): string;

    public function testWrongModelValue()
    {
        $user = $this->createUniqueUser();
        $user->name = 'custom-name';
        $this->expectException(RuntimeException::class);
        $this->getComponent()->model($user)->name('name')->toHtml();
    }

    public function testSetCustomFormat()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->toHtml();
        $this->assertStringContainsString($user->published_at->format('d/m/Y H-i-s'), $html);
    }

    public function testSetFormatOverridesDefault()
    {
        config()->set(
            'bootstrap-components.components.' . $this->getComponentKey(),
            get_class($this->getCustomComponent())
        );
        $user = $this->createUniqueUser();
        $user->published_at = $this->faker->dateTime;
        $html = $this->getComponent()->model($user)->name('published_at')->format('Y-m-d')->toHtml();
        $this->assertStringContainsString($user->published_at->format('Y-m-d'), $html);
        $this->assertStringNotContainsString($user->published_at->format('d/m/Y H-i-s'), $html);
    }

    public function testSetNoFormat()
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->name('published_at')->format('')->toHtml();
    }

    public function testSetWrongValue()
    {
        $this->expectException(RuntimeException::class);
        $this->getComponent()->name('name')->value('custom-value')->toHtml();
    }

    public function testSetValue()
    {
        $value = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        $this->assertStringContainsString(' value="' . $value->format($this->getFormat()) . '"', $html);
    }

    public function testSetZeroValue()
    {
        $html = $this->getComponent()->name('name')->value(0)->toHtml();
        $this->assertStringContainsString(' value=""', $html);
    }

    public function testSetEmptyStringValue()
    {
        $html = $this->getComponent()->name('name')->value('')->toHtml();
        $this->assertStringContainsString(' value=""', $html);
    }

    public function testSetNullValue()
    {
        $html = $this->getComponent()->name('name')->value(null)->toHtml();
        $this->assertStringContainsString(' value=""', $html);
    }

    public function testSetValueFromClosureWithDisabledMultilingual()
    {
        $value = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value(function () use ($value) {
            return $value;
        })->toHtml();
        $this->assertStringContainsString(' value="' . $value->format($this->getFormat()) . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = $this->faker->dateTime->format($this->getFormat());
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($value)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $value . '"', $html);
    }

    public function testOldArrayValue()
    {
        $oldValue = $this->faker->dateTime->format($this->getFormat());
        $value = $this->faker->dateTime->format($this->getFormat());
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => [0 => $oldValue]]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name[0]')->value($value)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $value . '"', $html);
    }
}
