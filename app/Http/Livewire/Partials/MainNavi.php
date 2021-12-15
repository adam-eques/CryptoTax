<?php

namespace App\Http\Livewire\Partials;

use Laravel\Jetstream\Http\Livewire\NavigationMenu;

class MainNavi extends NavigationMenu
{
    /**
     * @var array|array[]
     */
    public array $navItems = [];

    /**
     * MainNavi constructor.
     */
    public function __construct()
    {
        $user = \Auth::user();

        if($user->isAdminAccount()) {
            $this->navItems = [
                ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
                ["label" => __('User'), 'icon' => 'fas-users', 'route' => 'admin.users.index'],
            ];
        }
        else if($user->isCustomerAccount()) {
            $this->navItems = [
                ["label" => __('Dashboard'), 'icon' => 'dashboard', 'route' => 'dashboard'],
                ["label" => __('Wallets'), 'icon' => 'wallet', 'route' => 'customer.wallet'],
                ["label" => __('Portfolio'), 'icon' => 'portfolio', 'route' => 'customer.portfolio'],
                ["label" => __('Taxes'), 'icon' => 'tax', 'route' => 'customer.taxes'],
                ["label" => __('Advisor'), 'icon' => 'advisor', 'route' => 'customer.advisor'],
                ["label" => __('Services'), 'icon' => 'services', 'route' => 'customer.services'],
            ];
        }
        else if($user->isTaxAdvisorAccount()) {
            $this->navItems = [
                ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
            ];
        }
        else if($user->isSupportAccount()) {
            $this->navItems = [
                ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
            ];
        }
        else if($user->isEditorAccount()) {
            $this->navItems = [
                ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
            ];
        }
    }

    public function render()
    {
        return view('livewire.partials.main-navi');
    }
}
