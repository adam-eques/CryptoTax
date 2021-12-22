<?php

namespace App\Http\Livewire\Admin\Resources;

use App\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ButtonAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use WireUi\Traits\Actions;

abstract class ResourceTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    use Actions;

    public bool $disableAdd = false;
    public string $resourceClass;
    protected Resource $resource;


    public function booted(): void
    {
        $this->resource = ($this->resourceClass)::make();
    }


    protected function getTableQuery(): Builder
    {
        return ($this->resource->model())::query();
    }


    protected function getTableColumns(): array
    {
        return ($this->resource)->getTableColumns();
    }


    protected function getTableActions(): array
    {
        return [
            ButtonAction::make('edit')
                ->label(__("Edit"))
                ->color("primary")
                ->url(function ($record): string {
                    return $this->resource->getRoute('edit', $record);
                })
                ->icon('heroicon-o-pencil'),
            ButtonAction::make('delete')
                ->label(__("Delete"))
                ->color("danger")
                ->icon('heroicon-o-trash')
                ->action(function ($record) {
                    $this->notification()
                        ->success(
                            __("Successfully deleted"),
                            __("\":name\" deleted", ["name" => $record->getName()])
                        );
                    return $record->delete();
                })
            ->requiresConfirmation()
        ];
    }


    protected function getTableBulkActions(): array
    {
        return [
            BulkAction::make('delete')
                ->label(__("Delete"))
                ->color("danger")
                ->icon('heroicon-o-trash')
                ->action(function (Collection $records) {
                    $this->notification()
                        ->success(
                            __("Successfully deleted"),
                            $records->count() > 1
                                ? __(":count entries deleted", ["count" => $records->count()])
                                : __("One entry deleted")
                        );
                    return $records->each->delete();
                })
                ->requiresConfirmation()
                ->deselectRecordsAfterCompletion()
        ];
    }


    public function render(): \Illuminate\View\View
    {
        return view('livewire.admin.resource.table', [
            "createRoute" => !$this->disableAdd ? $this->resource->getRoute('create') : null
        ]);
    }
}
