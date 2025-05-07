<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class db_backup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $timestamp = Carbon::now()->format('dmyHis');
        $backupdir = database_path("backup/$timestamp");
        if (!is_dir($backupdir)) {
            mkdir($backupdir, 0777, true);
        }

        $sourceFile = database_path("database.sqlite");
        $destFile = "$backupdir/database.sqlite";

        if (copy($sourceFile, $destFile)) {
            $this->info("Database backup folder is: $timestamp");
            $this->info("Database backup created at: $destFile");
        } else {
            $this->error("something went wrong");
        }
    }
}
