<?php

namespace App\Http\Livewire\Admin;

use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

abstract class AbstractTable extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;


    /**
     * @return string
     */
    public function render()
    {
        return '<div>' . $this->table->toHtml() .'</div>';
    }
}
