<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CoinRow extends Component
{
    public string $name = "";
    public string $label = "";
    public string $icon = "";
    public string $color = "";
    public string $short = "";
    public ?int $transactions;
    public ?float $price;
    public ?float $amount;

    public function __construct($coin = [], ?string $name = null, ?int $transactions = null, ?float $price = null, ?float $amount = null)
    {
        // Coin as array/object
        if($coin) {
            $name = $name ?: data_get($coin, "name");
            $transactions = $transactions ?: data_get($coin, "transactions");
            $price = $price ?: data_get($coin, "price");
            $amount = $amount ?: data_get($coin, "amount");
        }

        // Set values
        $this->name = $name;
        $this->transactions = $transactions;
        $this->price = $price;
        $this->amount = $amount;

        // Default set
        $this->initItem($this->name);
    }

    public function render()
    {
        return view("components.coin-row");
    }

    private function initItem($name)
    {
        $this->short = $name;

        switch ($name) {
            case "BTC":
                $this->label = "Bitcoin";
                $this->icon = "cri-btc";
                $this->color = "e79934";
                break;
            case "LTC":
                $this->label = "Lite Coin";
                $this->icon = "cri-ltc";
                $this->color = "c0c0c0";
                break;
            case "XRP":
                $this->label = "Ripple";
                $this->icon = "cri-xrp";
                $this->color = "000";
                break;
            case "MIOTA":
                $this->label = "Miota";
                $this->icon = "cri-miota";
                $this->color = "000";
                break;
            case "DASH":
                $this->label = "Dash";
                $this->icon = "cri-dash";
                $this->color = "3a90db";
                break;
            case "ETH":
                $this->label = "Ethereum";
                $this->icon = "cri-eth";
                $this->color = "545454";
                break;
            default:
                $this->label = $name;
                $this->icon = "fas-question-circle";
                $this->color = "CCC";
                break;
        }
    }
}
