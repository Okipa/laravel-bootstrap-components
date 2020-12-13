<?php

namespace Okipa\LaravelBootstrapComponents\Components\Traits;

use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectableAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract;
use Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\UploadableAbstract;

trait FormComponentsTrait
{
    public function inputText(): MultilingualAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract $inputText */
        $inputText = app(config('bootstrap-components.components.text'));

        return $inputText;
    }

    public function inputEmail(): InputAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract $inputEmail */
        $inputEmail = app(config('bootstrap-components.components.email'));

        return $inputEmail;
    }

    public function inputPassword(): InputAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract $inputPassword */
        $inputPassword = app(config('bootstrap-components.components.password'));

        return $inputPassword;
    }

    public function inputUrl(): InputAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract $inputUrl */
        $inputUrl = app(config('bootstrap-components.components.url'));

        return $inputUrl;
    }

    public function inputTel(): InputAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract $inputUrl */
        $inputUrl = app(config('bootstrap-components.components.tel'));

        return $inputUrl;
    }

    public function inputNumber(): InputAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract $inputNumber */
        $inputNumber = app(config('bootstrap-components.components.number'));

        return $inputNumber;
    }

    public function inputColor(): InputAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\InputAbstract $inputColor */
        $inputColor = app(config('bootstrap-components.components.color'));

        return $inputColor;
    }

    public function inputDate(): TemporalAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract $inputDate */
        $inputDate = app(config('bootstrap-components.components.date'));

        return $inputDate;
    }

    public function inputTime(): TemporalAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract $inputTime */
        $inputTime = app(config('bootstrap-components.components.time'));

        return $inputTime;
    }

    public function inputDatetime(): TemporalAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\TemporalAbstract $inputDatetime */
        $inputDatetime = app(config('bootstrap-components.components.datetime'));

        return $inputDatetime;
    }

    public function inputFile(): UploadableAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\UploadableAbstract $inputFile */
        $inputFile = app(config('bootstrap-components.components.file'));

        return $inputFile;
    }

    public function inputCheckbox(): CheckableAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract $inputCheckbox */
        $inputCheckbox = app(config('bootstrap-components.components.checkbox'));

        return $inputCheckbox;
    }

    public function inputSwitch(): CheckableAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\CheckableAbstract $inputSwitch */
        $inputSwitch = app(config('bootstrap-components.components.switch'));

        return $inputSwitch;
    }

    public function inputRadio(): RadioAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\RadioAbstract $inputRadio */
        $inputRadio = app(config('bootstrap-components.components.radio'));

        return $inputRadio;
    }

    public function textarea(): MultilingualAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\MultilingualAbstract $textarea */
        $textarea = app(config('bootstrap-components.components.textarea'));

        return $textarea;
    }

    public function select(): SelectableAbstract
    {
        /** @var \Okipa\LaravelBootstrapComponents\Components\Form\Abstracts\SelectableAbstract $select */
        $select = app(config('bootstrap-components.components.select'));

        return $select;
    }
}
