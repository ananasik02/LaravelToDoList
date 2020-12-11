<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\RenewSubscription;
use App\Notifications\TaskAssigned;
use Illuminate\Console\Command;

class MounthlyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'month:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a monthly email to the user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    //public $user;
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
//        $users = User::all();
//        foreach ($users as $user)
//        {
//            $user->notify(new RenewSubscription($user));
//        }
//        $this->info('Hourly Update has been send successfully');
        //$this->user->notify(new RenewSubscription($this->user));
        dd("I work");
    }
}
