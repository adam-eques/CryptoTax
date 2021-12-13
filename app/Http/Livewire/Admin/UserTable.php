<?php

namespace App\Http\Livewire\Admin;

use App\Models\User as CurrentModel;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UserTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    public function render()
    {
        return '<div>' . $this->table->toHtml() .'</div>';
    }


    protected function getTableQuery(): Builder
    {
        return CurrentModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\ButtonAction::make('edit')
                ->color("primary")
                ->icon('heroicon-o-pencil')
                ->url(fn (CurrentModel $record): string => route('admin.users.edit', $record))
        ];
    }
}
