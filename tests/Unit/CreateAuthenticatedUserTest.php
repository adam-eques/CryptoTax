<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\UserCreditAction;
use App\Services\CreditCodeService;
use Tests\TestCase;

class CreateAuthenticatedUserTest extends TestCase
{
    protected User $user;


    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        $this->user->delete();
    }


    public function test_permissions(): void
    {
        $user = $this->user;
        $this->assertFalse($user->isAdminPanelAccount());
        $this->assertTrue($user->isCustomerPanelAccount());
    }


    public function test_verified(): void
    {
        $user = $this->user;
        $this->assertTrue($user->hasVerifiedEmail());
    }


    public function test_register_credits_value(): void
    {
        $user = $this->user;
        $expected = UserCreditAction::findAction(CreditCodeService::ACTION_REGISTER);
        $this->assertEquals($user->credits, $expected->value);
        $this->assertEquals($user->creditLogs()->count(), 1);
    }
}
