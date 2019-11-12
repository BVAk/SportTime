<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Admin::create([
            'name' => 'Admin', 'phone' => '+3807777777','email' => 'bekkviktoria@gmail.com', 'password' => bcrypt('123456')
        ]);
    }
}
