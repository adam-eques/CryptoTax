<?php

namespace App\Services;

use App\Http\Livewire\Admin\BackendUser\BackendUserResource;
use App\Http\Livewire\Admin\CryptoExchange\CryptoExchangeResource;
use App\Http\Livewire\Admin\Customer\CustomerResource;
use App\Http\Livewire\Admin\TaxAdvisor\TaxAdvisorResource;

class NavigationService
{
    /**
     * @var $this
     */
    protected static self $instance;

    /**
     * @var array
     */
    protected array $items = [];
    /**
     * @var array
     */
    protected array $subnavi = [];

    public function __construct()
    {
        $user = \Auth::user();

        if($user->isAdminAccount()) {
            $this->adminAccountItems();
        }
        else if($user->isCustomerAccount()) {
            $this->customerAccountItems();
        }
        else if($user->isTaxAdvisorAccount()) {
            $this->taxAdvisorAccountItems();
        }
        else if($user->isSupportAccount()) {
            $this->supportAccountItems();
        }
        else if($user->isEditorAccount()) {
            $this->editorAccountItems();
        }
    }

    /**
     * @return static
     */
    public static function instance(): self
    {
        return static::$instance ?? (static::$instance = new self());
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return array
     */
    public function getTopLevelItems(): array
    {
        return array_map(function($row){
            unset($row["actions"], $row["children"]);
            return $row;
        }, $this->items);
    }


    /**
     * @param array $children
     * @param array $actions
     * @return $this
     */
    public function overwriteSubnavi(array $children, array $actions = []): self
    {
        $this->subnavi = [
            "children" => $children,
            "actions" => $actions
        ];

        return $this;
    }


    /**
     * @return array
     */
    public function getSubnavi(): array
    {
        return $this->subnavi ?: $this->getRouteItem();
    }


    /**
     * @return array
     */
    public function getRouteItem(): array
    {
        $result = array_filter($this->items, function ($row) {
            return request()->routeIs($row["route"]);
        });

        return $result ? current($result) : [];
    }

    /**
     * @param string $topItemLabel
     * @return array
     */
    public function getItem(string $topItemLabel): array
    {
        $result = array_filter($this->items, function ($row) use ($topItemLabel) {
            return $row["label"] == $topItemLabel;
        });

        return current($result);
    }

    /**
     * @param array $array
     * @return $this
     */
    protected function addItems(array $array): self
    {
        foreach($array AS $row) {
            $this->addItem($row["label"], $row["icon"] ?? null, $row["route"] ?? null, $row["children"] ?? [], $row["actions"] ?? []);
        }

        return $this;
    }

    /**
     * @param string $label
     * @param string|null $icon
     * @param string|null $route
     * @param array $children
     * @param array $actions
     * @return $this
     */
    protected function addItem(string $label, ?string $icon = null, ?string $route = null, array $children = [], array $actions = []): self
    {
        $this->items[] = [
            'label' => $label,
            'icon' => $icon,
            'route' => $route,
            'children' => $children,
            'actions' => $actions,
        ];

        return $this;
    }


    private function adminAccountItems()
    {
        $this->addItems([
            ["label" => __('Dashboard'), 'icon' => 'dashboard', 'route' => 'dashboard'],
            ["label" => __('User'), 'children' => [
                CustomerResource::make()->sidebar(),
                TaxAdvisorResource::make()->sidebar(),
                BackendUserResource::make()->sidebar()
            ]],
            ["label" => __('Advertising'), 'children' => [
                ["label" => "Advertising", "icon" => "fas-ad", "route" => "todo"],
            ]],
            ["label" => __('Finance'), 'children' => [
                ["label" => "Finance", "icon" => "fas-coins", "route" => "todo"],
            ]],
            ["label" => __('API\'s'), 'children' => [
                CryptoExchangeResource::make()->sidebar(),
            ]],
            ["label" => __('Administration'), 'children' => [
                ["label" => "Telescope", "icon" => "fas-binoculars", "route" => "telescope", "target" => "_blank"],
            ]],
        ]);
    }


    private function customerAccountItems()
    {
        $this->addItems([
            ["label" => __('Dashboard'), 'icon' => 'dashboard', 'route' => 'dashboard',
                "children" => [
                    ["label" => __('Markets'), 'icon' => 'market', 'route' => 'dashboard'],
                    ["label" => __('Watchlist'), 'icon' => 'watchlist', 'route' => 'customer.wallet'],
                ],
                "actions" => [
                    ["label" => __('Invite a Friend'), 'icon' => 'invite', 'route' => 'customer.invite', 'color' => 'text-white bg-primary'],
                ]
            ],
            ["label" => __('Accounts'), 'icon' => 'wallet', 'route' => 'customer.wallet',
                "children" => [
                    ["label" => __('Transactions'), 'icon' => 'market', 'route' => 'transactions1'],
                ],
                "actions" => [
                    ["label" => __('Invite a Friend'), 'icon' => 'invite', 'route' => 'customer.invite', 'color' => 'text-white bg-primary'],
                ]
            ],
            ["label" => __('Portfolio'), 'icon' => 'portfolio', 'route' => 'customer.portfolio',
                "children" => [
                    ["label" => __('Markets'), 'icon' => 'market', 'route' => 'dashboard'],
                    ["label" => __('Watchlist'), 'icon' => 'watchlist', 'route' => 'customer.wallet'],
                ],
                "actions" => [
                    ["label" => __('Invite a Friend'), 'icon' => 'invite', 'route' => 'customer.invite', 'color' => 'text-white bg-primary'],
                ]
            ],
            ["label" => __('Taxes'), 'icon' => 'tax', 'route' => 'customer.taxes',
                "children" => [
                    ["label" => __('Markets'), 'icon' => 'market', 'route' => 'dashboard'],
                    ["label" => __('Watchlist'), 'icon' => 'watchlist', 'route' => 'customer.wallet'],
                ],
                "actions" => [
                    ["label" => __('Invite a Friend'), 'icon' => 'invite', 'route' => 'customer.invite', 'color' => 'text-white bg-primary'],
                ]
            ],
            ["label" => __('Advisor'), 'icon' => 'advisor', 'route' => 'customer.advisor',
                "children" => [
                    ["label" => __('Markets'), 'icon' => 'market', 'route' => 'dashboard'],
                    ["label" => __('Watchlist'), 'icon' => 'watchlist', 'route' => 'customer.wallet'],
                ],
                "actions" => [
                    ["label" => __('Invite a Friend'), 'icon' => 'invite', 'route' => 'customer.invite', 'color' => 'text-white bg-primary'],
                ]
            ],
            ["label" => __('Services'), 'icon' => 'service', 'route' => 'customer.services',
                "children" => [
                    ["label" => __('Markets'), 'icon' => 'market', 'route' => 'dashboard'],
                    ["label" => __('Watchlist'), 'icon' => 'watchlist', 'route' => 'customer.wallet'],
                ],
                "actions" => [
                    ["label" => __('Invite a Friend'), 'icon' => 'invite', 'route' => 'customer.invite', 'color' => 'text-white bg-primary'],
                ]
            ],
        ]);
    }


    private function taxAdvisorAccountItems()
    {
        $this->addItems([
            ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
        ]);
    }


    private function supportAccountItems()
    {
        $this->addItems([
            ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
        ]);
    }


    private function editorAccountItems()
    {
        $this->addItems([
            ["label" => __('Dashboard'), 'icon' => 'fas-home', 'route' => 'dashboard'],
        ]);
    }
}
