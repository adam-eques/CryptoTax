<?php

namespace App\Http\Livewire\Admin;

use App\Models\CryptoExchange as CurrentModel;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;

class ApiTable extends AbstractTable
{
    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getTableQuery(): Builder
    {
        $query = CurrentModel::query();

        return $query;
    }

    /**
     * @return array
     */
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")->sortable()->searchable(),
            Tables\Columns\BooleanColumn::make("active")->sortable(),
        ];
    }

    /**
     * @return array
     */
    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ButtonAction::make('edit')
                ->color("primary")
                ->icon('heroicon-o-pencil')
                ->url(fn (CurrentModel $record): string => route('admin.api.edit', $record))
        ];
    }
}
