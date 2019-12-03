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
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 1000; $i++) {
            
            $email = $faker->unique()->freeEmail;
            User::create([
                'name' => $faker->name,
                'email' => $email,
                'phone' => $faker->unique()->phoneNumber,
                'card' => $faker->unique()->numberBetween(1, 9999),
                'password' => bcrypt($email),
                'created_at' => $faker->dateTimeBetween('-3 years', 'now'),
            ]);
        }
    }

}
