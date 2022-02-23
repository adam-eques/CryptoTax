<?php

namespace App\Http\Livewire\UserSetting;

use Livewire\Component;
use App\Models\Models\User;

class Profile extends Component
{
    public?string $name = null;
    public?string $phone = null;

    public function mount()
    {

        $this->name = auth()->user()->name;
        $this->phone = '';

    }

    public function update_userprofile()
    {
        $user = auth()->user();

        if($user)
        {
            $user->name = $this->name;
            $user->save();
        }
    }

    public function render()
    {
        return view('livewire.user-setting.profile');
    }
}
