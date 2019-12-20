<?php

namespace Okipa\LaravelBootstrapComponents;

use Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\FileAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\RadioAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract;

class Component
{
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract
     */
    public function inputText(): MultilingualAbstract
    {
        return app(config('bootstrap-components.form.components.text'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputEmail(): FormAbstract
    {
        return app(config('bootstrap-components.form.components.email'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputPassword(): FormAbstract
    {
        return app(config('bootstrap-components.form.components.password'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputUrl(): FormAbstract
    {
        return app(config('bootstrap-components.form.components.url'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputTel(): FormAbstract
    {
        return app(config('bootstrap-components.form.components.tel'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputNumber(): FormAbstract
    {
        return app(config('bootstrap-components.form.components.number'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputColor(): FormAbstract
    {
        return app(config('bootstrap-components.form.components.color'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract
     */
    public function inputDate(): TemporalAbstract
    {
        return app(config('bootstrap-components.form.components.date'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract
     */
    public function inputTime(): TemporalAbstract
    {
        return app(config('bootstrap-components.form.components.time'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract
     */
    public function inputDatetime(): TemporalAbstract
    {
        return app(config('bootstrap-components.form.components.datetime'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FileAbstract
     */
    public function inputFile(): FileAbstract
    {
        return app(config('bootstrap-components.form.components.file'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract
     */
    public function inputCheckbox(): CheckableAbstract
    {
        return app(config('bootstrap-components.form.components.checkbox'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract
     */
    public function inputToggle(): CheckableAbstract
    {
        return app(config('bootstrap-components.form.components.toggle'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\RadioAbstract
     */
    public function inputRadio(): RadioAbstract
    {
        return app(config('bootstrap-components.form.components.radio'));
    }
}
