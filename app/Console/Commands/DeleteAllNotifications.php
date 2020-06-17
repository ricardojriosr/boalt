<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notification; // Use the notification model

class DeleteAllNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete All Notifications';

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
        Notification::truncate(); // Delete All Records
    }
}
