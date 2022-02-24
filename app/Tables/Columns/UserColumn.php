<?php

namespace App\Tables\Columns;

use App\CaravelAdmin\Resources\Customer\CustomerResource;
use WebCaravel\Admin\Tables\Columns\BelongsToColumn;

class UserColumn extends BelongsToColumn
{

    public static function make(string $name = "user.name"): static
    {
        return parent::make($name)
            ->subtitle(fn($record): ?string => $record->user->email)
            ->resource(CustomerResource::class);
    }
}
