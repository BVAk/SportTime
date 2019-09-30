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
        //
        $faker = \Faker\Factory::create();

        for($i=0; $i<=10; $i++):
            DB::table('trainers')->insert([
                        'name' => $faker-> name($gender = 'male'),
                        'birth' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years', $timezone = null),
                        'start' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
                        'phone' => $faker->unique()->phoneNumber,
                        'image' => "images/trainers/man$i.jpg",
               ]); endfor;
               for($i=0; $i<=10; $i++):
                DB::table('trainers')->insert([
                            'name' => $faker-> name($gender = 'female'),
                            'birth' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-18 years', $timezone = null),
                            'start' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null),
                            'phone' => $faker->unique()->phoneNumber,
                            'image' => "images/trainers/woman$i.jpg",
                   ]); endfor;
    }    
}
