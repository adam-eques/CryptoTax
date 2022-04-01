<?php

namespace App\CaravelAdmin\Resources\Customer\Modals;

use App\Models\UserCreditAction;
use Carbon\Carbon;
use Closure;
use Filament\Forms;
use WebCaravel\Admin\Resources\FormModal;

class AddCreditModal extends FormModal
{
    public array $data = [
        "created_at" => ""
    ];


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
                ->label(__("Amount of credits")),
            Forms\Components\DateTimePicker::make("created_at")
                ->label("Date")
                ->placeholder(__("Default = now"))
        ];
    }


    public function submit(): void
    {
        /**
         * @var \App\Models\User $user
         */
        $user = $this->parentRecord;
        $data = $this->form->getState();
        $action = UserCreditAction::find($data["user_credit_action_id"]);
        $user->creditAction($action, null, $data["value"], $data["created_at"] ? Carbon::make($data["created_at"]) : now());
        $this->notification()->success(__("Credits added"));
        $this->closeModal();
    }
}
