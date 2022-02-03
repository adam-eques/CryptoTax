<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Tables\Actions\Concerns\CanRequireConfirmation;
use Filament\Tables\Actions\Concerns\HasColor;

class ButtonField extends Field
{
    use HasColor, CanRequireConfirmation;

    protected string $view = 'forms.components.button-field';
    protected ?string $buttonLabel = null;
    protected ?string $action = null;
    protected ?string $heading = null;
    protected ?string $subHeading = null;


    public function action(string $action): self
    {
        $this->action = $action;

        return $this;
    }


    public function getAction(): string
    {
        return $this->action ?: $this->getName();
    }

    /**
     * @return string|null
     */
    public function getHeading(): ?string
    {
        return $this->heading;
    }

    /**
     * @param string|null $heading
     * @return self
     */
    public function heading(?string $heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubHeading(): ?string
    {
        return $this->subHeading;
    }

    /**
     * @param string|null $subheading
     * @return self
     */
    public function subHeading(?string $subHeading): self
    {
        $this->subHeading = $subHeading;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getButtonLabel(): ?string
    {
        return $this->buttonLabel ?: $this->getLabel();
    }

    /**
     * @param string|null $buttonLabel
     * @return self
     */
    public function buttonLabel(?string $buttonLabel): self
    {
        $this->buttonLabel = $buttonLabel;

        return $this;
    }
}
