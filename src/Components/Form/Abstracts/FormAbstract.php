<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Database\Eloquent\Model;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class FormAbstract extends ComponentAbstract
{
    protected ?string $method = null;

    protected ?string $action = null;

    protected ?string $enctype = null;

    protected ?Model $model = null;

    protected bool $labelPositionedAbove;

    protected bool $displaySuccess;

    protected bool $displayFailure;

    public function __construct()
    {
        parent::__construct();
        $this->labelPositionedAbove = $this->setLabelPositionedAbove();
        $this->displaySuccess = $this->setDisplaySuccess();
        $this->displayFailure = $this->setDisplayFailure();
    }

    protected function checkValuesValidity(): void
    {
        //
    }

    public function setType(): string
    {
        return 'form';
    }

    public function method(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function action(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function enctype(string $enctype): self
    {
        $this->enctype = $enctype;

        return $this;
    }

    public function model(?Model $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function labelPositionedAbove(bool $positionedAbove = true): self
    {
        $this->labelPositionedAbove = $positionedAbove;

        return $this;
    }

    public function displaySuccess(bool $displaySuccess = true): self
    {
        $this->displaySuccess = $displaySuccess;

        return $this;
    }

    public function displayFailure(bool $displayFailure = true): self
    {
        $this->displayFailure = $displayFailure;

        return $this;
    }

    protected function getViewParams(): array
    {
        return array_merge(parent::getViewParams(), [
            'method' => $this->getMethod(),
            'action' => $this->getAction(),
            'enctype' => $this->getEnctype(),
            'model' => $this->getModel(),
            'labelPositionedAbove' => $this->getLabelPositionedAbove(),
            'displaySuccess' => $this->getDisplaySuccess(),
            'displayFailure' => $this->getDisplayFailure(),
        ]);
    }

    protected function getMethod(): ?string
    {
        return $this->method;
    }

    protected function getAction(): ?string
    {
        return $this->action;
    }

    protected function getEnctype(): ?string
    {
        return $this->enctype;
    }

    protected function getModel(): ?Model
    {
        return $this->model;
    }

    protected function getLabelPositionedAbove(): bool
    {
        return $this->labelPositionedAbove;
    }

    protected function getDisplaySuccess(): bool
    {
        return $this->displaySuccess;
    }

    protected function getDisplayFailure(): bool
    {
        return $this->displayFailure;
    }
}
