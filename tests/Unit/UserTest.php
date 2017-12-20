<?php
namespace Tests\Unit;

use App\User;
use Mockery\Exception;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function  testUserCanNotChangeLevel()
    {
        $user = new User();
/*        $user->membership = "Selller";*/
        $user->name= "amr";
        $user->email= "amrh434@gmail.com";
        $user->password= bcrypt('password');
        $user->remember_token= str_random(10);
        $user->membership = "Seller";

        try{
            $user->save();
            $this->assertTrue(false);
        }catch (\Illuminate\Database\QueryException $e){
            $this->assertTrue(true);
        }

        /*$user->setFirstName('Billy');
        $this->assertEquals($user->getFirstName(),'Billy');*/
    }
    public  function testCheckSellerUser(){
        $this->assertDatabaseHas('users', [
            'membership' => 'Seller'
        ]);
    }
}
