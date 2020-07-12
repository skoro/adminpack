<?php

namespace Skoro\AdminPack\Console;

use Illuminate\Console\Command;

class OptionGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:get {name : Option name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get the option value';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $value = option($name, null);

        if ($value === null) {
            $this->error("Option '$name' value not found.");
        } else {
            $this->info($value);
        }
    }
}
