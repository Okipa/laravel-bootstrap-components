<?php

namespace Okipa\LaravelBootstrapComponents\Components\Traits;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FileAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;

trait FormComponentsTrait
{
    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract
     */
    public function inputText(): MultilingualAbstract
    {
        return app(config('bootstrap-components.components.text'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputEmail(): FormAbstract
    {
        return app(config('bootstrap-components.components.email'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputPassword(): FormAbstract
    {
        return app(config('bootstrap-components.components.password'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputUrl(): FormAbstract
    {
        return app(config('bootstrap-components.components.url'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputTel(): FormAbstract
    {
        return app(config('bootstrap-components.components.tel'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputNumber(): FormAbstract
    {
        return app(config('bootstrap-components.components.number'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputColor(): FormAbstract
    {
        return app(config('bootstrap-components.components.color'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract
     */
    public function inputDate(): TemporalAbstract
    {
        return app(config('bootstrap-components.components.date'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract
     */
    public function inputTime(): TemporalAbstract
    {
        return app(config('bootstrap-components.components.time'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract
     */
    public function inputDatetime(): TemporalAbstract
    {
        return app(config('bootstrap-components.components.datetime'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FileAbstract
     */
    public function inputFile(): FileAbstract
    {
        return app(config('bootstrap-components.components.file'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract
     */
    public function inputCheckbox(): CheckableAbstract
    {
        return app(config('bootstrap-components.components.checkbox'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract
     */
    public function inputToggle(): CheckableAbstract
    {
        return app(config('bootstrap-components.components.toggle'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract
     */
    public function inputRadio(): RadioAbstract
    {
        return app(config('bootstrap-components.components.radio'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract
     */
    public function textarea(): MultilingualAbstract
    {
        return app(config('bootstrap-components.components.textarea'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectAbstract
     */
    public function select(): SelectAbstract
    {
        return app(config('bootstrap-components.components.select'));
    }
}
