<?php

namespace App\Http\Livewire\Admin;

use App\Models\User as CurrentModel;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UserTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;
    public array $accountTypeIds = [];

    /**
     * @return string
     */
    public function render()
    {
        return '<div>' . $this->table->toHtml() .'</div>';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function getTableQuery(): Builder
    {
        $query = CurrentModel::query()
            ->with("userAccountType");

        if($this->accountTypeIds) {
            $query->whereIn("user_account_type_id", $this->accountTypeIds);
        }

        return $query;
    }

    /**
     * @return array
     */
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make("name")->sortable()->searchable(),
            Tables\Columns\TextColumn::make("email")->label("E-Mail"),
            Tables\Columns\TextColumn::make("userAccountType.name")->label("Type"),
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
                ->url(fn (CurrentModel $record): string => route('admin.' . $record->getRouteSlug() . '.edit', $record))
        ];
    }
}
