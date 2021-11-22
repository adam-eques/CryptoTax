<?php

namespace App\Http\Livewire\Partials;

use Laravel\Jetstream\Http\Livewire\NavigationMenu;

class SubNavi extends NavigationMenu
{
    /**
     * @var array
     */
    public array $navItems = [];

    /**
     * @var array
     */
    public array $actions = [];


    public function __construct()
    {
        $this->navItems = [
            ["label" => __('Markets'), 'icon' => 'fas-shopping-cart', 'route' => 'dashboard'],
            ["label" => __('Watchlist'), 'icon' => 'fas-binoculars', 'route' => 'wallet'],
            ["label" => __('News'), 'icon' => 'fas-newspaper', 'route' => 'portfolio'],
            ["label" => __('Invite a Friend'), 'icon' => 'fas-user-plus', 'route' => 'taxes'],
        ];
        $this->actions = [
            ["label" => __('Share'), 'icon' => 'fas-share-alt', 'route' => 'todo', 'color' => 'text-blue-800 bg-color-2'],
            ["label" => __('Settings'), 'icon' => 'fas-cogs', 'route' => 'todo', 'color' => 'text-white bg-color'],
        ];
    }

    public function render()
    {
        return view('livewire.partials.sub-navi');
    }
}
