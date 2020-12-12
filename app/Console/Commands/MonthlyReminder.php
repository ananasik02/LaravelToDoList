<?php

namespace App\Console\Commands;

use App\Notifications\RenewSubscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MonthlyReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'month:remind';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a monthly reminder to renew subscription';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $user;
    public function __construct()
    {
        parent::__construct();
        //$this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //$this->user->notify(new RenewSubscription());
        //Log::info("Cron is working fine!");
        Mail::raw('plain text message', function ($message) {
            $message->to('poweleg286@hebgsw.com')
                ->subject('Test');
        });
        return 0;
    }
}
