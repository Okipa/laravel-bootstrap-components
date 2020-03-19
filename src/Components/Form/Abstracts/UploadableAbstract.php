<?php

namespace Okipa\LaravelBootstrapComponents\Components\Form\Abstracts;

use Illuminate\Support\HtmlString;
use Okipa\LaravelBootstrapComponents\Components\ComponentAbstract;

abstract class UploadableAbstract extends FormAbstract
{
    /**
     * The uploaded file closure.
     *
     * @property callable $uploadedFile
     */
    protected $uploadedFile;

    /**
     * The show remove file checkbox status.
     *
     * @property bool $showRemoveCheckbox
     */
    protected $showRemoveCheckbox;

    /**
     * The remove-file-checkbox label.
     *
     * @property string $removeCheckboxLabel
     */
    protected $removeCheckboxLabel;

    /**
     * File constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->showRemoveCheckbox = $this->setShowRemoveCheckbox();
    }

    /**
     * Set the uploaded file closure.
     *
     * @param callable $uploadedFile
     *
     * @return $this
     */
    public function uploadedFile(callable $uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }

    /**
     * Show the remove checkbox.
     *
     * @param bool $showRemoveCheckbox
     * @param string|null $removeCheckboxLabel
     *
     * @return $this
     */
    public function showRemoveCheckbox(bool $showRemoveCheckbox = true, string $removeCheckboxLabel = null): self
    {
        $this->showRemoveCheckbox = $showRemoveCheckbox;
        $this->removeCheckboxLabel = $removeCheckboxLabel;

        return $this;
    }

    /** @inheritDoc */
    protected function getValues(): array
    {
        return array_merge(parent::getValues(), [
            'uploadedFileHtml' => $this->getUploadedFileHtml(),
            'showRemoveCheckbox' => $this->getShowRemoveCheckbox(),
            'removeCheckboxLabel' => $this->getRemoveCheckboxLabel(parent::getValues()['label']),
        ]);
    }

    /**
     * Get the uploadedFile HTML.
     *
     * @return HtmlString
     */
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

    /**
     * @return bool
     */
    protected function getShowRemoveCheckbox(): bool
    {
        return $this->showRemoveCheckbox;
    }

    /**
     * @return bool
     */
    abstract protected function setShowRemoveCheckbox(): bool;

    /**
     * @param string|null $label
     *
     * @return string
     */
    protected function getRemoveCheckboxLabel(?string $label): string
    {
        $defaultRemoveCheckboxLabel = ((string) __('Remove')) . ($label ? ' ' . strtolower($label) : '');

        return $this->removeCheckboxLabel ?? $defaultRemoveCheckboxLabel;
    }

    /** @inheritDoc */
    protected function getPlaceholder(): ?string
    {
        return $this->placeholder ?? (string) __('No file selected.');
    }
}
