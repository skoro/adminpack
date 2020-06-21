<?php

namespace Skoro\AdminPack\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AdminInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize AdminPack package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Executing seeders...');
        Artisan::call('db:seed', [
            '--class' => \Skoro\AdminPack\Seeders\AdminSeeder::class,
        ]);
    }
}
