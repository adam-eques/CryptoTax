<?php

namespace App\CaravelAdmin\Resources\Customer\Modals;

use App\Models\UserCreditAction;
use Closure;
use Filament\Forms;
use WebCaravel\Admin\Resources\FormModal;

class AddCreditModal extends FormModal
{
    public function getTextBefore(): ?string
    {
        return __("Here you can add credits. Think twice before you do this!");
    }


    protected function getFormSchema(): array
    {
        $actions = UserCreditAction::active()->get()->pluck("name", "id");

        return [
            Forms\Components\Select::make("user_credit_action_id")
                ->label(__("Select action to add credits for"))
                ->required()
                ->reactive()
                ->afterStateUpdated(function (Closure $set, $state) {
                    if($value = optional(UserCreditAction::query()->where("id", $state)->first())->value) {
                        $set('value', $value);
                    }
                })
                ->options($actions),
            Forms\Components\TextInput::make("value")
                ->placeholder("First select credit action")
                ->postfix("Credits")
                ->required()
                ->hidden(fn($get): bool => !$get("user_credit_action_id"))
                ->label(__("Amount of credits"))
        ];
    }


    public function submit()
    {
        /**
         * @var \App\Models\User $user
         */
        $user = $this->parentRecord;
        $data = $this->form->getState();
        $action = UserCreditAction::find($data["user_credit_action_id"]);
        $user->creditAction($action, null, $data["value"]);
        $this->notification()->success(__("Credits added"));

        return $this->reloadPage();
    }
}
