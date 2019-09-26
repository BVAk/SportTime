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
        //
        $faker = \Faker\Factory::create();

    $trainer_id=DB::table('trainers')->pluck('id');
     $training_id=DB::table('trainings')->pluck('id');
     
foreach($trainer_id as $trainer_id):
    for($i=0; $i<=2; $i++):
     DB::table('traintrain')   ->insert([
                    'trainer_id' => ($trainer_id),
                    'training_id' => $faker->randomElement($training_id),
           ]);
            endfor;
        endforeach;
    }    
}
