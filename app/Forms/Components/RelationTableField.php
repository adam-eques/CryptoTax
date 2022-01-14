<?php

namespace App\Forms\Components;

use App\Http\Livewire\Admin\Resources\Resource;
use Filament\Forms\Components\Field;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RelationTableField extends Field
{
    protected string $view = 'forms.components.relation-table-field';
    protected ?string $relationship = null;
    protected bool $disableAdd = false;


    public function getResource(): ?Resource
    {
        return Resource::makeByModel($this->getRelationship()->getRelated());
    }

    public function getRelationship(): BelongsToMany
    {
        $model = $this->getModel();

        if (is_string($model)) {
            $model = new $model();
        }

        return $model->{$this->getRelationshipName()}();
    }


    public function getRelationshipName(): string
    {
        return $this->evaluate($this->relationship ?: $this->getName());
    }

    /**
     * @return bool
     */
    public function isDisableAdd(): bool
    {
        return $this->disableAdd;
    }

    /**
     * @param bool $disableAdd
     * @return self
     */
    public function disableAdd(bool $disableAdd = true): self
    {
        $this->disableAdd = $disableAdd;

        return $this;
    }
}
