<?php

namespace Okipa\LaravelBootstrapComponents\Tests\Unit\Form\Abstracts;

use Carbon\Carbon;
use Exception;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

abstract class TemporalTestAbstract extends InputTestAbstract
{
    abstract protected function getFormat(): string;

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

    public function testWrongModelValue()
    {
        $user = $this->createUniqueUser();
        $user->name = 'custom-name';
        $this->expectException(Exception::class);
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
        $this->expectException(Exception::class);
        $this->getComponent()->name('published_at')->format('')->toHtml();
    }

    public function testSetWrongValue()
    {
        $customValue = 'custom-value';
        $this->expectException(Exception::class);
        $this->getComponent()->name('name')->value($customValue)->toHtml();
    }

    public function testSetValue()
    {
        $customValue = $this->faker->dateTime;
        $html = $this->getComponent()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $customValue->format($this->getFormat()) . '"', $html);
    }

    public function testOldValue()
    {
        $oldValue = $this->faker->dateTime->format('Y-m-d');
        $customValue = $this->faker->dateTime->format('Y-m-d');
        $this->app['router']->get('test', [
            'middleware' => 'web', 'uses' => function () use ($oldValue) {
                $request = request()->merge(['name' => $oldValue]);
                $request->flash();
            },
        ]);
        $this->call('GET', 'test');
        $html = $this->getComponent()->name('name')->value($customValue)->toHtml();
        $this->assertStringContainsString(' value="' . $oldValue . '"', $html);
        $this->assertStringNotContainsString(' value="' . $customValue . '"', $html);
    }
}
