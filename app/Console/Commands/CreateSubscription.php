<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Subscription;

class CreateSubscription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'add new type of subscription';

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
        $name = $this->ask('What is the name of subscription?');
        $value = $this->ask('what is the value of subscription (must be among 0.00 to 9999.99) ?');

        $sub = new Subscription();
        $sub->name = $name;
        $sub->amount = $value;
        $sub->save();

        return (print("Subscription " . $name . " has been created, its value is: " . $value));
    }
}
