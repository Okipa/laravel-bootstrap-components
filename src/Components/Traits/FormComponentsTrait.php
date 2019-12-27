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
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract $inputText */
        $inputText = app(config('bootstrap-components.components.text'));

        return $inputText;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputEmail(): FormAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract $inputEmail */
        $inputEmail = app(config('bootstrap-components.components.email'));

        return $inputEmail;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputPassword(): FormAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract $inputPassword */
        $inputPassword = app(config('bootstrap-components.components.password'));

        return $inputPassword;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputUrl(): FormAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract $inputUrl */
        $inputUrl = app(config('bootstrap-components.components.url'));

        return $inputUrl;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputTel(): FormAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract $inputUrl */
        $inputUrl = app(config('bootstrap-components.components.tel'));

        return $inputUrl;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputNumber(): FormAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract $inputNumber */
        $inputNumber = app(config('bootstrap-components.components.number'));

        return $inputNumber;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract
     */
    public function inputColor(): FormAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FormAbstract $inputColor */
        $inputColor = app(config('bootstrap-components.components.color'));

        return $inputColor;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract
     */
    public function inputDate(): TemporalAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract $inputDate */
        $inputDate = app(config('bootstrap-components.components.date'));

        return $inputDate;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract
     */
    public function inputTime(): TemporalAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract $inputTime */
        $inputTime = app(config('bootstrap-components.components.time'));

        return $inputTime;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract
     */
    public function inputDatetime(): TemporalAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract $inputDatetime */
        $inputDatetime = app(config('bootstrap-components.components.datetime'));

        return $inputDatetime;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FileAbstract
     */
    public function inputFile(): FileAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\FileAbstract $inputFile */
        $inputFile = app(config('bootstrap-components.components.file'));

        return $inputFile;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract
     */
    public function inputCheckbox(): CheckableAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract $inputCheckbox */
        $inputCheckbox = app(config('bootstrap-components.components.checkbox'));

        return $inputCheckbox;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract
     */
    public function inputToggle(): CheckableAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract $inputToggle */
        $inputToggle = app(config('bootstrap-components.components.toggle'));

        return $inputToggle;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract
     */
    public function inputRadio(): RadioAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract $inputRadio */
        $inputRadio = app(config('bootstrap-components.components.radio'));

        return $inputRadio;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract
     */
    public function textarea(): MultilingualAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract $textarea */
        $textarea = app(config('bootstrap-components.components.textarea'));

        return $textarea;
    }

    /**
     * @return \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectAbstract
     */
    public function select(): SelectAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectAbstract $select */
        $select = app(config('bootstrap-components.components.select'));

        return $select;
    }
}
