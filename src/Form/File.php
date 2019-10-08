<?php

namespace Okipa\LaravelBootstrapComponents\Form;

use Closure;
use Illuminate\Support\HtmlString;
use Okipa\LaravelBootstrapComponents\Component;

class File extends Input
{
    /**
     * The component config key.
     *
     * @property string $view
     */
    protected $configKey = 'form.file';
    /**
     * The input type.
     *
     * @property string $type
     */
    protected $type = 'file';
    /**
     * The uploaded file closure.
     *
     * @property \Closure $uploadedFile
     */
    protected $uploadedFile;
    /**
     * The show remove file checkbox status.
     *
     * @property boolean $showRemoveCheckbox
     */
    protected $showRemoveCheckbox;
    /**
     * The remove-file-checkbox label.
     *
     * @property string $removeCheckboxLabel
     */
    protected $removeCheckboxLabel;

    /**
     * Set the uploaded file closure.
     *
     * @param \Closure $uploadedFile
     *
     * @return $this
     */
    public function uploadedFile(Closure $uploadedFile): self
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

    /**
     * Set the input values.
     *
     * @return array
     * @throws \Exception
     */
    protected function values(): array
    {
        return array_merge(parent::values(), [
            'uploadedFileHtml'    => $this->getUploadedFileHtml(),
            'showRemoveCheckbox'  => $this->defineShowRemoveCheckboxStatus(),
            'removeCheckboxLabel' => $this->defineRemoveCheckboxLabel(parent::values()['label']),
            'placeholder'         => $this->placeholder ?? __('bootstrap-components::bootstrap-components.label.file'),
        ]);
    }

    /**
     * Get the uploadedFile HTML.
     *
     * @return \Illuminate\Support\HtmlString
     */
    protected function getUploadedFileHtml(): HtmlString
    {
        $uploadedFileHtml = '';
        $uploadedFile = $this->uploadedFile;
        if ($uploadedFile) {
            if ($uploadedFile() instanceof Component) {
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
    protected function defineShowRemoveCheckboxStatus(): bool
    {
        return isset($this->showRemoveCheckbox)
            ? $this->showRemoveCheckbox
            : $this->defaultRemoveCheckboxShowStatus();
    }

    /**
     * Set the file default checkbox show status
     *
     * @return bool
     */
    protected function defaultRemoveCheckboxShowStatus(): bool
    {
        $showRemoveCheckbox = boolval(config('bootstrap-components.' . $this->configKey . '.show_remove_checkbox'));

        return $showRemoveCheckbox;
    }

    /**
     * @param string|null $defaultLabel
     *
     * @return string
     */
    protected function defineRemoveCheckboxLabel(?string $defaultLabel): string
    {
        $translatedDefaultLabel = __($defaultLabel);
        $defaultRemoveCheckboxLabel = (string) __('bootstrap-components::bootstrap-components.label.remove')
            . ($translatedDefaultLabel ? ' ' . strtolower($translatedDefaultLabel) : '');

        return $this->removeCheckboxLabel ?? $defaultRemoveCheckboxLabel;
    }
}
