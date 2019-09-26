<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        for($i=0; $i<=100; $i++):
            DB::table('users')
                ->insert([
                    'name' => $faker->name,
                    'email' => $faker->unique()->freeEmail,
                    'phone' => $faker->unique()->phoneNumber,
                    'card' => $faker->unique()->numberBetween(1,999),
                    'password' => bcrypt($faker->password()),  
                    'created_at' => $faker->date,              ]);
        endfor;
         
    }    
}
