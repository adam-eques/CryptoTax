<?php

namespace App\Http\Livewire\Admin\Resources;

use App\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Filament\Forms;
use WireUi\Traits\Actions;

abstract class ResourceForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use Actions;

    public string $resourceClass;
    protected Resource $resource;
    public Model $model;


    protected function getFormSchema(): array
    {
        return ($this->resource)->getFormSchema();
    }


    public function booted(): void
    {
        if(!isset($this->resource)) {
            $this->resource = ($this->resourceClass)::make();
        }
    }


    public function mount(): void
    {
        if(!isset($this->resource)) {
            $this->resource = ($this->resourceClass)::make();
        }

        $this->model && $this->form->fill($this->model->toArray());
    }


    protected function getForms(): array
    {
        return [
            'form' => $this->makeForm()
                ->statePath('data')
                ->schema($this->getFormSchema())
                ->model($this->getFormModel()),
        ];
    }


    protected function getFormModel(): Model
    {
        return $this->model;
    }


    public function save()
    {
        $state = $this->form->getState();

        if ($this->model && $this->model->exists) {
            $this->model->update($state);

            $this->notification()->success(__("Saved successfully"));
        } else {
            $this->model = new ($this->resource->model())($state);
            $this->model->save();

            // Notify
            notify(__("Creation successfully"));

            return $this->redirect(
                $this->resource->getRoute("edit", $this->model)
            );
        }
    }


    public function render()
    {
        return view('livewire.admin.resource.form', [
            "resource" => $this->resource,
        ]);
    }
}
