<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\LivewirePage;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Filament\Forms;

class ApiForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use LivewirePage;

    public $model;


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('name')
                ->required(),
        ];
    }


    public function mount(): void
    {
        $this->form->fill($this->model->toArray());
    }

    /**
     * @return Model
     */
    protected function getFormModel(): Model
    {
        return $this->model;
    }


    public function save()
    {
        if($this->model && $this->model->exists) {
            $this->model->update(
                $this->form->getState(),
            );

            $this->toast(__('Saved'));
        }
        else {
            //$this->model = new Role($this->form->getState());
            //$this->model->save();
            //
            //return $this->redirect(route("app.roles.edit", [
            //    "model" => $this->model
            //]));
        }
    }


    public function render()
    {
        return view("livewire.model.form", [
            "cancel" => route('admin.api.index')
        ]);
    }
}
