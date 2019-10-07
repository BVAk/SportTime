<?php

use Illuminate\Database\Seeder;
use App\User;


class TraintrainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $faker = \Faker\Factory::create();

        $training_id = \Illuminate\Support\Facades\DB::table('trainings')->pluck('id');

        foreach (\App\Trainer::pluck('id') as $trainer_id) {
            for ($i = 0; $i <= 2; $i++) {
                \Illuminate\Support\Facades\DB::table('traintrain')->insert([
                    'trainer_id' => ($trainer_id),
                    'training_id' => $faker->randomElement($training_id),
                ]);
            }
        }
    }
}
