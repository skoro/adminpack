<?php

namespace Skoro\AdminPack\Console;

use Illuminate\Console\Command;

class OptionSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:set
                            {name : Option name}
                            {value : Option value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or update the option';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $value = $this->argument('value');

        if ($value === 'true' || $value == 'false') {
            $value = ($value === 'true');
        }
        
        option([$name => $value]);
        
        $value = option($name);

        $this->info("$name = $value");
    }
}
