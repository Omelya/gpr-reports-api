<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputArgument;

class CreateTestDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gpr-reports:create-test-database {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create test database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        echo $this->argument('name');
        $dbName = $this->argument('name');
        $db = DB::connection()->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = "."'".$dbName."'");
        if(empty($db)) {
            DB::connection()->select('CREATE DATABASE ' . $dbName);
            $this->info('The ' . $dbName . ' database has been created');
        } else $this->info('The ' . $dbName . ' database exists');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the database.'],
        ];
    }
}
