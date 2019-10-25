<?php

use Illuminate\Database\Seeder;

class ChildTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('groupshedule')->insert([
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-07 18:00:00','end'=>'2019-10-07 19:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-08 17:00:00','end'=>'2019-10-08 18:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-08 18:00:00','end'=>'2019-10-08 19:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-09 18:00:00','end'=>'2019-10-09 19:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-10 17:00:00','end'=>'2019-10-10 18:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-10 18:00:00','end'=>'2019-10-10 19:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-11 18:00:00','end'=>'2019-10-11 19:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-12 17:00:00','end'=>'2019-10-12 18:00:00'],
            ['train_id' => '105', 'room_id' => '3', 'start' => '2019-10-12 18:00:00','end'=>'2019-10-12 19:00:00'],
            ['train_id' => '106', 'room_id' => '3', 'start' => '2019-10-09 15:15:00','end'=>'2019-10-09 16:45:00'],
            ['train_id' => '106', 'room_id' => '3', 'start' => '2019-10-10 15:15:00','end'=>'2019-10-10 16:45:00'],
            ['train_id' => '107', 'room_id' => '3', 'start' => '2019-10-08 19:00:00','end'=>'2019-10-08 20:00:00'],
            ['train_id' => '107', 'room_id' => '3', 'start' => '2019-10-10 19:00:00','end'=>'2019-10-10 20:00:00'],
            ['train_id' => '107', 'room_id' => '3', 'start' => '2019-10-11 19:00:00','end'=>'2019-10-11 20:00:00'],
          ]);
    }
}
