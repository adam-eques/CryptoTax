<?php

namespace App\Http\Livewire\Customer\Test;

use App\Models\UserCreditAction;
use App\Services\CreditCodeService;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class BuyCredit extends Component
{
    public float $credits;
    public float $addedCredits = 0;
    public bool $showForm;


    public function mount()
    {
        $this->credits = auth()->user()->credits;
        $this->showForm = auth()->user()->isCustomerPanelAccount();
    }


    public function render()
    {
        return view('livewire.customer.test.buy-credit', [
            "options" => $this->getOptionsQuery()->get()
        ]);
    }


    public function pay(string $paymentId, int $priceId)
    {
        $user = auth()->user();

        // First get price
        if(!$priceAction = $this->getOptionsQuery()->where("id", $priceId)->first()) {
            abort(Response::HTTP_BAD_REQUEST, __("Invalid priceId"));
        }
        $price = $priceAction->price * 100; // Convert to cents

        // See https://stripe.com/docs/api/charges/create
        $stripeCharge = $user->charge($price, $paymentId, [
            "description" => $priceAction->name_public
        ]);

        // Log action
        $user->creditAction($priceAction);

        // Update credtis
        $this->credits = $user->credits;
        $this->showForm = false;
        $this->addedCredits = $priceAction->value;
    }


    private function getOptionsQuery(): Builder
    {
        return UserCreditAction::query()
            ->where("action_code", CreditCodeService::ACTION_BUY_CREDITS)
            ->active()
            ->orderBy("price");
    }
}
