<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class CreateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create {name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $databaseName = $this->argument('name') ?: config('database.connections.' . config('database.default') . '.database');

        $validator = Validator::make(['name' => $databaseName], [
            'name' => ['required', 'max:255', 'regex:/^[a-zA-Z0-9_]+$/'],
        ]);

        if ($validator->fails()) {
            return $this->error("Database $databaseName not created:" . $validator->errors()->first('name'));
        }

        if ($this->databaseExists($databaseName)) {
            return $this->error("Database $databaseName already exists.");
        }

        $this->createDatabase($databaseName);

        return Command::SUCCESS;
    }

    /**
     * check if there is a DB with provieded name
     * @param string $databaseName
     * @return bool
     */
    protected function databaseExists($databaseName)
    {
        $existingDatabases = DB::select("SHOW DATABASES WHERE `Database` = '$databaseName'");
        return count($existingDatabases) > 0;
    }

    /**
     * create new Database
     */
    protected function createDatabase($databaseName)
    {
        $charset = config('database.connections.' . config('database.default') . '.charset') ?: 'utf8mb4';
        $collation = config('database.connections.' . config('database.default') . '.collation') ?: 'utf8mb4_unicode_ci';

        DB::statement("CREATE DATABASE $databaseName CHARACTER SET $charset COLLATE $collation");

        Config::set("database.connections." . config('database.default') . ".database", $databaseName);

        $this->updateEnvFiles($databaseName);

        $this->info("Database $databaseName created successfully.");
    }

    /**
     * Update DB_DATABASE value in .env and .env.example files.
     */
    protected function updateEnvFiles($databaseName)
    {
        $envPath = base_path('.env');
        $examplePath = base_path('.env.example');

        // Update .env
        $envContents = File::get($envPath);
        $updatedEnvContents = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE={$databaseName}", $envContents);
        File::put($envPath, $updatedEnvContents);

        // Update .env.example
        $exampleContents = File::get($examplePath);
        $updatedExampleContents = preg_replace('/DB_DATABASE=.*/', "DB_DATABASE={$databaseName}", $exampleContents);
        File::put($examplePath, $updatedExampleContents);
    }
}
