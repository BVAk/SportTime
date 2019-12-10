<?php

use App\Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        
        $trainer_id = Trainer::all();
        foreach ($trainer_id as $trainer) {
         
            DB::table('admins')->insert(['name' => $trainer->name, 'email' => $trainer->email, 'phone' => $trainer->phone, 'password' => bcrypt($trainer->email), 'role' => 'trainer']);
      
        }
    }
}
