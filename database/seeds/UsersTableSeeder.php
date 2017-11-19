<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
           'name' => 'admin',
           'email' => 'admin@admin.com',
           'password' => bcrypt('password'),
            'membership'=>'Seller'
        ]);
        factory(App\User::class,10)->create();
    }
}
