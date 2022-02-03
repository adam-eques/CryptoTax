<?php

namespace App\Forms\Components;

use WebCaravel\Admin\Resources\Resource;
use Filament\Forms\Components\Field;
use Illuminate\Contracts\View\View;

class HasManyRelationField extends Field
{
    protected ?Resource $resource = null;
    protected string $view = 'forms.components.has-many-relation-field';


    public function resource(Resource $resource): self
    {
        $this->resource = $resource;

        return $this;
    }


    /**
     * @return \WebCaravel\Admin\Resources\Resource
     */
    public function getResource(): Resource
    {
        return $this->resource;
    }


    public function render(): View
    {
        return view($this->getView(), array_merge($this->data(), [
            'component' => $this,
        ]));
    }
}
