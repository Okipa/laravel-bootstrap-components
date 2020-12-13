<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Closure;
use Illuminate\Support\HtmlString;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class UploadableAbstract extends InputAbstract
{
    protected ?Closure $uploadedFile = null;

    protected bool $showRemoveCheckbox;

    protected ?string $removeCheckboxLabel;

    public function __construct()
    {
        parent::__construct();
        $this->showRemoveCheckbox = $this->setShowRemoveCheckbox();
    }

    public function uploadedFile(Closure $uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }

    public function showRemoveCheckbox(bool $showRemoveCheckbox = true, ?string $removeCheckboxLabel = null): self
    {
        $this->showRemoveCheckbox = $showRemoveCheckbox;
        $this->removeCheckboxLabel = $removeCheckboxLabel;

        return $this;
    }

    protected function getViewParams(): array
    {
        $parentViewParams = parent::getViewParams();

        return array_merge($parentViewParams, [
            'uploadedFileHtml' => $this->getUploadedFileHtml(),
            'showRemoveCheckbox' => $this->getShowRemoveCheckbox(),
            'removeCheckboxLabel' => $this->getRemoveCheckboxLabel($parentViewParams['label']),
            'removeCheckboxName' => $this->getShowRemoveCheckboxName(),
        ]);
    }

    protected function getUploadedFileHtml(): HtmlString
    {
        $uploadedFileHtml = '';
        $uploadedFile = $this->uploadedFile;
        if ($uploadedFile) {
            if ($uploadedFile() instanceof ComponentAbstract) {
                $uploadedFileHtml = $uploadedFile()->toHtml();
            } else {
                $uploadedFileHtml = $uploadedFile();
            }
        }

        return new HtmlString($uploadedFileHtml);
    }

    protected function getShowRemoveCheckbox(): bool
    {
        return $this->showRemoveCheckbox;
    }

    abstract protected function setShowRemoveCheckbox(): bool;

    protected function getRemoveCheckboxLabel(?string $label): string
    {
        $defaultRemoveCheckboxLabel = ((string) __('Remove')) . ($label ? ' ' . mb_strtolower($label) : '');

        return $this->removeCheckboxLabel ?? $defaultRemoveCheckboxLabel;
    }

    protected function getShowRemoveCheckboxName(): string
    {
        return 'remove_' . $this->getName();
    }

    protected function getPlaceholder(): ?string
    {
        return $this->placeholder ?? (string) __('No file selected.');
    }
}
