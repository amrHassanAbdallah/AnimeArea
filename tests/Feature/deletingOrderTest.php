<?php

namespace Tests\Feature;

use App\Category;
use App\item;
use App\Order;
use App\Product;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class deletingOrderTest extends TestCase
{
    protected $product ;
    protected $category;
    protected $order;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatingCategory()
    {
        $category = new Category();
        $category->name = "test";
        $this->assertTrue($category->save());
        $this->category =  $category;

    }
    public function testCreatingProduct()
    {
        $product = new Product();
        $product->Seller_id = 1;
        $product->category_id = 1;
        $product->code = "test";
        $product->name = "test";
        $product->image = "image";
        $product->price = 200;
        $product->description = "ffffff";
        $this->assertTrue($product->save());
        $this->product = $product;
    }
    /**
     * @depends testCreatingCategory
     * @depends testCreatingProduct
     */
    public function testCreatingOrder()
    {

        $order = new Order();
        $order->cart_id = 1;
        $order->is_paid = 1;
        $this->assertTrue($order->save());
        $this->order = $order;

    }
    /**
     * @depends testCreatingCategory
     * @depends testCreatingProduct
     * @depends testCreatingOrder
     */
    public function testCreatingItem(){
        $this->order =  DB::table('orders')->latest()->first();
        $item = new item();
        $item->product_id = 1;
        $item->price = 1234;
        $item->Quantity = 1;
        $item->category  = "t-shirts";
        $item->description = "ffffff";
        $this->order->Items()->save($item);

        $this->assertEquals(Item::class,get_class($item));
    }

    /**
     * @depends testCreatingCategory
     * @depends testCreatingProduct
     * @depends testCreatingOrder
     * @depends testCreatingItem
     */
   /* public function testDeletingOrder()
    {

        echo $this->order;
    }*/
}
