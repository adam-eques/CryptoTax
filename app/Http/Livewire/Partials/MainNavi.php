<?php

namespace App\Http\Livewire\Partials;

use Laravel\Jetstream\Http\Livewire\NavigationMenu;

class MainNavi extends NavigationMenu
{
    public array $navItems = [];

    /**
     * MainNavi constructor.
     */
    public function __construct()
    {
        $this->navItems = [
            ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
            ["label" => __('Wallets'), 'icon' => 'fas-wallet', 'route' => 'wallet'],
            ["label" => __('Portfolio'), 'icon' => 'fas-suitcase', 'route' => 'portfolio'],
            ["label" => __('Taxes'), 'icon' => 'fas-clipboard-list', 'route' => 'taxes'],
            ["label" => __('Advisor'), 'icon' => 'fas-user-nurse', 'route' => 'advisor'],
            ["label" => __('Services'), 'icon' => 'fas-file-invoice-dollar', 'route' => 'services'],
        ];
    }

    public function render()
    {
        return view('livewire.partials.main-navi');
    }
}
