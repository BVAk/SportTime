<?php

use App\User;
use Illuminate\Database\Seeder;

class UserAbonnement extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::get();
        for($i=0;$i<5;$i++){
        foreach ($user as $user1) {
            $abonnement = rand(1, 17);
           
            $start = strtotime($user1->created_at);
            $end = strtotime('now');
            $date1 = mt_rand($start, $end);
            $date = date('Y-m-d H:i:s', strtotime('+1day', $date1));
            
if(date('H',strtotime($date))>9 and date('H',strtotime($date))<20){
            if (DB::table('usersabonnements')->where('user_id', '=', $user1->id)->where('abonnement_id', '=', $abonnement)->where('end', '>=', $date)->exists()) {
                $userabomalready = DB::table('usersabonnements')->where('user_id', '=', $user1->id)->where('abonnement_id', '=', $abonnement)->where('end', '>=', $date)->first();
                $date = $userabomalready->end;
                $date1 = strtotime($date);
            }
            if ($abonnement == '1') {
                $end = date('Y-m-d H:i:s', strtotime('+3 month', $date1));
                $amount = 0;
            } else if ($abonnement == '2') {
                $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
                $amount = 0;
            } else if ($abonnement == '3') {
                $end = NULL;
                $amount = 1;
            } else if ($abonnement == '4') {
                $end = date('Y-m-d H:i:s', strtotime('+3 month', $date1));
                $amount = 0;
            } else if ($abonnement == '5') {
                $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
                $amount = 0;
            } else if ($abonnement == '6') {
                $end = date('Y-m-d H:i:s', strtotime('+3 month', $date1));
                $amount = 0;
            } else if ($abonnement == '7') {
                $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
                $amount = 0;
            } else if ($abonnement == '8') {
                $end = NULL;
                $amount = 1;
            } else if ($abonnement == '9') {
                $end = NULL;
                $amount = 1;
            } else if ($abonnement == '10') {
                $end = date('Y-m-d H:i:s', strtotime('+1 month', $date1));
                $amount = NULL;
            } else if ($abonnement == '11') {
                $end = NULL;
                $amount = 1;
            } else if ($abonnement == '12') {
                $end = NULL;
                $amount = 6;
            } else if ($abonnement == '13') {
                $end = NULL;
                $amount = 12;
            } else if ($abonnement == '14') {
                $end = NULL;
                $amount = 1;
            } else if ($abonnement == '15') {
                $end = NULL;
                $amount = 1;
            } else if ($abonnement == '16') {
                $end = NULL;
                $amount = 6;
            } else if ($abonnement == '17') {
                $end = NULL;
                $amount = 1;
            }
            DB::table('usersabonnements')->insert(['user_id' => $user1->id, 'abonnement_id' => $abonnement, 'date' => $date, 'end' => $end, 'amount' => $amount]);
        }
    }
    }
}}

