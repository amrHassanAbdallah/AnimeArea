<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$p1 = [
            'name' => '',
            'image' =>'',
            'price' => 5000,
            'description' => ';lfdksl;fkds ;lfkdsl f;ldsk ;lfdsk ;lfk ds;lfkds ;lfk',
            'Seller_id'=>1
        ];
        $p2 = [
            'name' => '',
            'image' =>'',
            'price' => 5000,
            'description' => ';lfdksl;fkds ;lfkdsl f;ldsk ;lfdsk ;lfk ds;lfkds ;lfk',
            'Seller_id'=>1
        ];

        \App\Product::create($p1);
        \App\Product::create($p2);*/
        \App\Category::create([
            'name'=>'t-shirts'
        ]);
        /*factory(App\Product::class,30)->create();*/
        factory(App\Product::class,30)->create();

    }
}
