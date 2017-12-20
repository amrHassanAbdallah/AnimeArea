<?php

namespace Tests\Feature;

use App\classes\CreditCardStrategy;
use App\classes\PaypalStrategy;
use App\User;
use App\Wallet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testThereisWalletForTheSeller()
    {
        $this->assertDatabaseHas('wallets', [
            'user_id' => 1
        ]);    }

    /**
     * @depends testThereisWalletForTheSeller
     */
    public function testTheUserCanNotCheckOutIfTheAmountInTheWalletEqualToZero(){
        $wallet = Wallet::where("user_id","=",1)->first();
        $this->assertTrue($wallet->amount == 0);
        if($wallet->amount>0){
            $OldAmount = $wallet->amount();
        }
        $user = User::find($wallet->user_id);
        $payment =new PaypalStrategy("asdasd@sadasd.com","123456");
        $this->assertEquals(0,$payment->withdraw());
    }

}
