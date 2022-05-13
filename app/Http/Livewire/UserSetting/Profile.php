<?php

namespace App\Http\Livewire\UserSetting;

use App\Http\Livewire\Traits\DemoUserTrait;
use Livewire\Component;

class Profile extends Component
{
    use DemoUserTrait;

    public?string $name = null;
    public?string $phone = null;

    public function mount()
    {

        $this->name = auth()->user()->name;
        $this->phone = '';

    }

    public function update_userprofile()
    {
        if($this->preventDemoUser()) return;
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
