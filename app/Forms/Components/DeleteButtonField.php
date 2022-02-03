<?php

namespace App\Forms\Components;


class DeleteButtonField extends ButtonField
{

    protected function setUp(): void
    {
        parent::setUp();
        $this->label(__("Löschen"))
            ->color("danger")
            ->heading(__("Löschen bestätigen"))
            ->buttonLabel(__("Löschen"))
            ->requiresConfirmation();

        $this->afterStateHydrated(function (self $component): void {
            $record = $component->getRecord();
            $this->subHeading = __("Sind Sie sicher, dass Sie <em>\":name\"</em> löschen möchten?", [
                "name" => $record->getName()
            ]);
        });
    }
}
