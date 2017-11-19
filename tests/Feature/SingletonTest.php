<?php

namespace Tests\Feature;

use App\classes\BestBookVoteSingleton;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SingletonTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfValueIncreased()
    {
        $newSing = BestBookVoteSingleton::getInstance(1);

        $this->assertEquals($newSing->Getvote(),0);
        $this->assertEquals($newSing->IncreaseVote(),1);
        $newSing2 = BestBookVoteSingleton::getInstance(1);
        $this->assertEquals($newSing2->Getvote(),1);
        $this->assertEquals($newSing->Getvote(),$newSing2->Getvote());

    }

}
