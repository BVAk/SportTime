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
        $grpschtble = DB::table('groupshedule')->get();
        foreach ($grpschtble as $sch) {
            $date = date_create_from_format('Y-m-d H:i:s', $sch->start);
            $date2 = date_create_from_format('Y-m-d H:i:s', $sch->end);
            DB::table('groupshedule')->where('id', '=', $sch->id)->update(['start' =>  $date->modify( '+7 days' ), 'end' => $date2->modify( '+7 days' )]);
        }
    
    }
    }

