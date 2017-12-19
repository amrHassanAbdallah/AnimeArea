<?php

namespace Tests\Feature;

use App\classes\PaypalStrategy;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckOutTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckIfTheSellerCanCheckOutThereWallet()
    {
        $user = User::find(1);
        $wallet = $user->Wallet;
        if($wallet){
            $amount = $wallet->amount;
            $wallet->amount = 1;
            $wallet->save();
            $withdraw = new PaypalStrategy($user->email,"123456789");
            $this->assertEquals("0",$withdraw->withdraw($user));

                $wallet->amount = $amount;
                $wallet->save();

        }else{
            $this->assertTrue(false);
        }

    }
    public function testCheckIfTheUserCanNotCheckOutIfTheyHaveNoWallet()
    {
        $user = new User();
        $user->id = 88;
        $user->email = "test@test.test";
        $wallet = $user->Wallet;
        if($wallet){
            $amount = $wallet->amount;
        }
        $withdraw = new PaypalStrategy($user->email,"123456789");
        $this->assertEquals(false,$withdraw->withdraw($user));
        if(isset($amount)){
            $wallet->amount = $amount;
            $wallet->save();
        }
    }
    public function testCheckIfTheUserCanNotCheckOutIfTheyHaveNoNoMoneyInTheWallet()
    {
        $user = User::find(1);
        $wallet = $user->Wallet;
        if($wallet){
            $amount = $wallet->amount;
            $wallet->amount = 0;
            $wallet->save();
            $this->assertEquals(0,$wallet->amount);
            $withdraw = new PaypalStrategy($user->email,"123456789");
            $this->assertEquals(false,$withdraw->withdraw($user));

                $wallet->amount = $amount;
                $wallet->save();

        }else{

            $this->assertTrue(false);
        }

    }
}
