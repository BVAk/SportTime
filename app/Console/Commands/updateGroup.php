<?php

namespace App\Console\Commands;
use DB;
use Illuminate\Console\Command;

class updateGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'group:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $grpschtble = DB::table('groupshedule');
        foreach ($grpschtble as $sch) {
            $date1 = $sch->start;
            $date2 = $sch->end;
            DB::table('groupshedule')->where('id', '=', $grpschtble->id)->update(['start' => date('Y-m-d H:i:s', strtotime('+1 week', $date1)), 'end' => date('Y-m-d H:i:s', strtotime('+1 week', $date2))]);
        }
    }
    }

