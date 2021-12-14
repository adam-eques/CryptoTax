<?php

namespace App\Http\Livewire;

trait LivewirePage
{
    /**
     * @param string $msg
     * @param string $type  success|warning|error|info
     * @return void
     */
    public function toast(string $msg, string $type = 'success')
    {
        $this->emitTo('livewire-toast', 'show', $msg);
    }

    /**
     * @param string $msg
     * @return void
     */
    public function toastError(string $msg)
    {
        return $this->toast($msg, "error");
    }
}
