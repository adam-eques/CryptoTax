<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Component;

class StaticField extends Component
{
    protected string $view = 'forms.components.static-field';
    protected string|\Closure|null $label = null;
    public $valueOrCallback;


    public static function make($label, ?string $value = null, ?callable $callback = null, ?string $modelValue = null)
    {
        $obj = new static();
        $obj->label = $label;

        // Value
        if($value) $obj->setValue($value);
        else if($callback) $obj->setCallback($callback);
        else if($modelValue) $obj->setModelValue($modelValue);

        return $obj;
    }


    public function setValue(string $value): self
    {
        $this->valueOrCallback = $value;

        return $this;
    }


    public function setCallback(callable $callback): self
    {
        $this->valueOrCallback = $callback;

        return $this;
    }


    public function setModelValue(string $name): self
    {
        $this->valueOrCallback = function($record) use ($name) {
            return $record && is_object($record) ? $record->$name : null;
        };

        return $this;
    }


    public function getValue(): ?string
    {
        if(is_callable($this->valueOrCallback)) {
            return call_user_func($this->valueOrCallback, $this->getRecord());
        }
        else {
            return $this->valueOrCallback;
        }
    }
}
