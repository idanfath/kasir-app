<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use function PHPUnit\Framework\fileExists;

class db_restore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:restore {folder code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Restore backupped database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $foldername = $this->argument("folder code");
        $backupfile = database_path("backup/$foldername/database.sqlite");
        $destinationfile = database_path("database.sqlite");

        if (!file_exists($backupfile)) {
            $this->error("backup file not found!");
            return;
        }

        $this->info("for everyone sake, current database will be backupped");
        $this->call('db:backup');

        $this->info("restoring database...");
        if (copy($backupfile, $destinationfile)) {
            $this->info("success!");
        } else {
            $this->error("something went wrong!");
        }
    }
}
