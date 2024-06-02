<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class ImportMasterData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:master-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates master user data and insert into the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $output = new ConsoleOutput();
        $path = public_path('sql/welcome.sql');
        if (file_exists($path)) {
            if (DB::unprepared(file_get_contents($path))) {
                $output->writeln('Data Import Successfully.');
            } else {
                $output->writeln('Something Error...');
            }
        } else {
            $output->writeln('File Missing "public/sql/visitor.sql"');
        }
    }
}
