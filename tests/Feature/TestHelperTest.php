<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Helpers\TestHelper;

class TestHelperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $possibles = [1, 3, 20];
        $ret = TestHelper::save2file('Kucoin_possibleMethods', $possibles);
        $this->assertTrue($ret, 'save2file failed');
    }
}
