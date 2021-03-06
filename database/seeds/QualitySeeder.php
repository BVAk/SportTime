<?php

use App\User;
use App\Quality;
use Illuminate\Database\Seeder;

class QualitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::get();
        foreach ($user as $user1) {
            $start = strtotime($user1->created_at);
            $end = strtotime('now');
            $date1 = mt_rand($start, $end);
            $date = date('Y-m-d H:i:s', strtotime('+1day', $date1));
            Quality::create(['user_id' => $user1->id, 'place' => rand(5, 10), 'organization' => rand(5, 10), 'cost' => rand(5, 10), 'assortment' => rand(5, 10), 'hygiene' => rand(5, 10), 'material' => rand(5, 10), 'quality_lesson' => rand(5, 10), 'created_at' => $date]);
        }
        //
    }
}
