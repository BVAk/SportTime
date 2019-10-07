<?php

use Illuminate\Database\Seeder;

class TrainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i <= 10; $i++){
            $trainer = [
                'name' => $faker->name($gender = 'male'),
                'birth' => $faker->dateTimeBetween('-30 years', '-18 years'),
                'start' => $faker->dateTimeBetween('-5 years', 'now'),
                'phone' => $faker->unique()->phoneNumber,
                'image' => "images/trainers/man$i.jpg",
            ];
            \App\Trainer::create($trainer);

            $trainer['name'] = $faker->name($gender = 'female');
            $trainer['image'] = "images/trainers/woman$i.jpg";
            $trainer['phone'] = $faker->unique()->phoneNumber;
            \App\Trainer::create($trainer);
        }
    }
}
