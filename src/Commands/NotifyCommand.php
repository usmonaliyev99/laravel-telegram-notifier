<?php

namespace Usmonaliyev\LaravelTelegramNotifier\Commands;

use Error;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class NotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command that generates an error to test package functionality.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call("config:clear");

        $message = $this->ask("What message do you want send to telegram ?");

        throw new Error($message);
    }
}
