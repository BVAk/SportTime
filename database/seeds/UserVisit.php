<?php

use Illuminate\Database\Seeder;

use App\Trainer;

class UserVisit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = DB::table('usersabonnements')->get();
        $groupschedule = DB::table('groupshedule')->where('room_id', '=', '2')->get();
        $now = strtotime('now');
        foreach ($user as $user1) {
            $start = strtotime($user1->date);
            //групові тренування
            if ($start < $now) {
                if ($user1->abonnement_id == '1' or '2' or '4' or '5') {


                    $start = strtotime($user1->date);
                    $train = rand(1, 24);
                    $groupschedule = DB::table('groupshedule')->where('id', '=', $train)->first();
                    $starttrain = strtotime($groupschedule->start);
                    $minutes = rand(1, 24);
                    $countweek = '-' . date('w', $starttrain - $start) . ' weeks -' . $minutes . ' minutes';
                    $date = date('Y-m-d H:i:s', strtotime($countweek, $starttrain));
                    DB::table('visiting')->insert(['user_id' => $user1->user_id, 'date' => $date]);
                }
                //індивідуальні тренування 1 раз
                if ($user1->abonnement_id == '3' or '8') {

                    $start = date('Y-m-d H:i:s', strtotime($user1->date));
                    if (($user1->amount) > 0) {
                        DB::table('visiting')->insert(['user_id' => $user1->user_id, 'date' => $start]);
                        DB::table('usersabonnements')->where('id', '=', $user1->id)->update(['amount' => ($user1->amount - 1)]);
                    }
                }

                //індивідуальні тренування багато разів
                if ($user1->abonnement_id == '6' or '7') {
                    $rand = rand(1, 5);
                    $start = date('Y-m-d H:i:s', strtotime('+' . $rand . 'days', strtotime($user1->date)));
                    if (($user1->amount) > 0) {
                        DB::table('visiting')->insert(['user_id' => $user1->user_id, 'date' => $start]);
                        DB::table('usersabonnements')->where('id', '=', $user1->id)->update(['amount' => ($user1->amount - 1)]);
                    }
                }
                //тренування із тренером багато разів
                if ($user1->abonnement_id = '12' or '13' or '16') {


                    $trainers = Trainer::whereHas("trainings", function ($q) {
                        $q->whereIn("name", ["Індивідуальні заняття в тренажерному залі", "Індивідуальні заняття в фітнес залі"]);
                    })->get();
                    $trainer = count($trainers) > 0 ? $trainers[rand(0, count($trainers) - 1)] : null;
                    $ran = rand(0, 20);
                    $start = date('Y-m-d H:i:s', strtotime('+' . $rand . 'days', strtotime($user1->date)));
                    $trainergym2 = DB::table('traintrain')->where('trainer_id', '=', $trainer->id)->whereIn('training_id',['1','2'])->first();
                    $trainer = $trainergym2->trainer_id;
                    $training = $trainergym2->training_id;
                    if (($user1->amount) > 0) {
                        DB::table('privateschedule')->insert(['user_id' => $user1->user_id, 'trainer_id' => $trainer, 'training_id' => $training, 'date' => $start, 'endtrain' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($start))), 'checked' => '1']);
                        DB::table('visiting')->insert(['user_id' => $user1->user_id, 'date' => date('Y-m-d H:i:s', strtotime('-' . $ran . 'minutes', strtotime($start)))]);
                        DB::table('usersabonnements')->where('id', '=', $user1->id)->update(['amount' => ($user1->amount - 1)]);
                    }
                }

                //тренування із тренером
                if ($user1->abonnement_id = '11' or '14' or '15' or '17') {
                    $start = date('Y-m-d H:i:s', strtotime($user1->date));

                    $trainers = Trainer::whereHas("trainings", function ($q) {
                        $q->whereIn("name", ["Індивідуальні заняття в тренажерному залі", "Індивідуальні заняття в фітнес залі"]);
                    })->get();
                    $trainer = count($trainers) > 0 ? $trainers[rand(0, count($trainers) - 1)] : null;
                    $ran = rand(0, 20);
                    $trainergym2 = DB::table('traintrain')->where('trainer_id', '=', $trainer->id)->whereIn('training_id',['1','2'])->first();
                    $trainer = $trainergym2->trainer_id;
                    $training = $trainergym2->training_id;
                    if (($user1->amount) > 0) {
                        DB::table('privateschedule')->insert(['user_id' => $user1->user_id, 'trainer_id' => $trainer, 'training_id' => $training, 'date' => $start, 'endtrain' => date('Y-m-d H:i:s', strtotime('+1 hour', strtotime($start))), 'checked' => '1']);
                        DB::table('visiting')->insert(['user_id' => $user1->user_id, 'date' => date('Y-m-d H:i:s', strtotime('-' . $ran . 'minutes', strtotime($start)))]);
                        DB::table('usersabonnements')->where('id', '=', $user1->id)->update(['amount' => ($user1->amount - 1)]);
                    }
                }

                //дитяче тренування
                if ($user1->abonnement_id == '10') {

                    $start = strtotime($user1->date);
                    $end = ($user1->end);
                    $train = rand(25, 38);
                    $groupschedule = DB::table('groupshedule')->where('id', '=', $train)->first();
                    $starttrain = strtotime($groupschedule->start);
                    $endtrain = strtotime($groupschedule->end);
                    $minutes = rand(1, 24);
                    $countweek = '-' . date('w', $starttrain - $start) . ' weeks -' . $minutes . ' minutes';
                    $date = date('Y-m-d H:i:s', strtotime($countweek, $starttrain));
                    DB::table('visiting')->insert(['user_id' => $user1->user_id, 'date' => $date]);
                }
            }
        }
    }
}
