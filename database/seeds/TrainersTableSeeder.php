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
                'email' => $faker->unique()->freeEmail,
                'birth' => $faker->dateTimeBetween('-30 years', '-18 years'),
                'start' => $faker->dateTimeBetween('-5 years', 'now'),
                'phone' => $faker->unique()->phoneNumber,
                'image' => "images/trainers/man$i.jpg",
                'salary'=>'7000'
            ];
            \App\Trainer::create($trainer);

            $trainer['name'] = $faker->name($gender = 'female');
            $trainer['email'] = $faker->unique()->freeEmail;
            $trainer['image'] = "images/trainers/woman$i.jpg";
            $trainer['phone'] = $faker->unique()->phoneNumber;
            \App\Trainer::create($trainer);
        }
    }
}
