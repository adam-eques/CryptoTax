<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Placeholder;

class ButtonField extends Placeholder
{
    protected string $view = 'forms.components.button-field';
    protected bool $targetBlank = false;
    protected string|\Closure $href;


    /**
     * @return string|null
     */
    public function getHref(): ?string
    {
        return $this->evaluate($this->href);
    }


    public function getContent()
    {
        return isset($this->content) ? $this->evaluate($this->content) : $this->getLabel();
    }


    public function targetBlank(bool $val = true): self
    {
        $this->targetBlank = $val;

        return $this;
    }


    public function href(string|\Closure $val): self
    {
        $this->href = $val;

        return $this;
    }


    /**
     * @return bool
     */
    public function isTargetBlank(): bool
    {
        return $this->targetBlank;
    }
}
