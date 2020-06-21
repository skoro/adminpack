<?php

namespace Skoro\AdminPack\Console;

use Skoro\AdminPack\Facades\Option;
use Illuminate\Console\Command;

class OptionSet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:set
                            {key : Option key}
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
        $key = $this->argument('key');
        $value = $this->argument('value');

        if ($value === 'true' || $value == 'false') {
            $value = ($value === 'true');
        }
        
        Option::set($key, $value);
        
        $value = Option::get($key);

        $this->info("$key = $value");
    }
}
