<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Filament\Forms;


class WalletNew extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $blockchain;
    public $walletType;
    public $cryptoCurrency;
    public $address;


    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('blockchainType')
                ->label(__("Blockchain type"))
                ->options([
                    "Option 1",
                    "Option 2",
                    "Option 3"
                ])
                ->searchable()
                ->placeholder(__("Choose your wallet/exchange")),
            Forms\Components\Select::make('blockchainType')
                ->label(__("Cryptocurrency"))
                ->options([
                    "BTC",
                    "ETC",
                    "XRP",
                    "DOGE",
                ])
                ->searchable()
                ->placeholder(__("Choose your cryptocurrency")),
            Forms\Components\TextInput::make('address')
                ->label(__("Address"))
                ->placeholder(__("Type your address")),
        ];
    }


    public function submit()
    {

    }


    public function render()
    {
        return view('livewire.wallet-new');
    }
}
