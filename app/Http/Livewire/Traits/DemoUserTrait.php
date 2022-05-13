<?php

namespace App\Http\Livewire\Traits;

use WireUi\Traits\Actions;

trait DemoUserTrait
{
    use Actions;

    protected function preventDemoUser(?string $msg = null): bool
    {
        if(auth()->user()->isDemoAccount()) {
            $this->notification()->info(
                __("Demo user"),
                __($msg ?: "As a demo user, you aren't allowed to do this")
            );

            return true;
        }

        return false;
    }
}
