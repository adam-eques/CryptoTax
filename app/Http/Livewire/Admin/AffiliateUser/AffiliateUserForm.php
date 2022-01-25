<?php

namespace App\Http\Livewire\Admin\AffiliateUser;

use App\Forms\SidebarLayout;
use App\Http\Livewire\Admin\Resources\ResourceForm;
use Filament\Forms;

class AffiliateUserForm extends ResourceForm
{
    protected function getFormSchema(): array
    {
        return SidebarLayout::make()
            ->addTab([
                Forms\Components\TextInput::make('name')
                    ->label(__("Name"))
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email(),
                Forms\Components\BelongsToSelect::make('user_account_type_id')
                    ->required()
                    ->relationship("userAccountType", "name")
                    ->label("Type"),
            ])
            ->toArray();
    }
}
