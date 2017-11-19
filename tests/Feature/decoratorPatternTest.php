<?php

namespace Tests\Feature;

use App\classes\backbag;
use App\classes\Color;
use App\classes\NormalProduct;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class decoratorPatternTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $product = new NormalProduct();
        $back = new backbag($product);
        $totall = $back->getCost();
        $this->assertEquals($totall,39);

    }
    public function testIfCanHandle2Der()
    {
        $product = new NormalProduct();
        $totall = (new color((new backbag($product))))->getCost();
        $this->assertEquals($totall,72);

    }
}
