<?php

namespace Okipa\LaravelBootstrapComponents;

use Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract;
use Okipa\LaravelBootstrapComponents\Buttons\Abstracts\SubmitAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\FileAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\RadioAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\SelectAbstract;
use Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract;
use Okipa\LaravelBootstrapComponents\Media\Abstracts\MediaAbstract;

class Component
{
    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract
     */
    public function inputText(): MultilingualAbstract
    {
        return app(config('bootstrap-components.components.text'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputEmail(): FormAbstract
    {
        return app(config('bootstrap-components.components.email'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputPassword(): FormAbstract
    {
        return app(config('bootstrap-components.components.password'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputUrl(): FormAbstract
    {
        return app(config('bootstrap-components.components.url'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputTel(): FormAbstract
    {
        return app(config('bootstrap-components.components.tel'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputNumber(): FormAbstract
    {
        return app(config('bootstrap-components.components.number'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FormAbstract
     */
    public function inputColor(): FormAbstract
    {
        return app(config('bootstrap-components.components.color'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract
     */
    public function inputDate(): TemporalAbstract
    {
        return app(config('bootstrap-components.components.date'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract
     */
    public function inputTime(): TemporalAbstract
    {
        return app(config('bootstrap-components.components.time'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\TemporalAbstract
     */
    public function inputDatetime(): TemporalAbstract
    {
        return app(config('bootstrap-components.components.datetime'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\FileAbstract
     */
    public function inputFile(): FileAbstract
    {
        return app(config('bootstrap-components.components.file'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract
     */
    public function inputCheckbox(): CheckableAbstract
    {
        return app(config('bootstrap-components.components.checkbox'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\CheckableAbstract
     */
    public function inputToggle(): CheckableAbstract
    {
        return app(config('bootstrap-components.components.toggle'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\RadioAbstract
     */
    public function inputRadio(): RadioAbstract
    {
        return app(config('bootstrap-components.components.radio'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\MultilingualAbstract
     */
    public function textarea(): MultilingualAbstract
    {
        return app(config('bootstrap-components.components.textarea'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Form\Abstracts\SelectAbstract
     */
    public function select(): SelectAbstract
    {
        return app(config('bootstrap-components.components.select'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\SubmitAbstract
     */
    public function submit(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.submit'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\SubmitAbstract
     */
    public function submitCreate(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.create'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\SubmitAbstract
     */
    public function submitUpdate(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.update'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\SubmitAbstract
     */
    public function submitValidate(): SubmitAbstract
    {
        return app(config('bootstrap-components.components.validate'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    public function button(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.button'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    public function buttonLink(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.link'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    public function buttonBack(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.back'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Buttons\Abstracts\ButtonAbstract
     */
    public function buttonCancel(): ButtonAbstract
    {
        return app(config('bootstrap-components.components.cancel'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Abstracts\MediaAbstract
     */
    public function image(): MediaAbstract
    {
        return app(config('bootstrap-components.components.image'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Abstracts\MediaAbstract
     */
    public function audio(): MediaAbstract
    {
        return app(config('bootstrap-components.components.audio'));
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Media\Abstracts\MediaAbstract
     */
    public function video(): MediaAbstract
    {
        return app(config('bootstrap-components.components.video'));
    }
}
