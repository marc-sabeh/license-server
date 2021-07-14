<?php

namespace App\Console\Commands;

use App\Models\License_info;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Foundation\Auth\User;

class ValidateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Validate:cron';

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
     * @return int
     */
    public function handle()
    {
        $license_info = License_info::all();
        $date_now = Carbon::now();
        foreach($license_info as $license){
            $diff = $date_now->diffInDays($license->expiry_date, false);
            

            if($diff <= 0)
            {
                $user = User::where('license_info_id', $license->id)->get();
                $user_save =User::find($user[0]->id);
                $user_save->license_info_id= null;
                $user_save->save();
        
                $this->info('Removed all Licenses that are invalid');
            }
        }
    }
}
