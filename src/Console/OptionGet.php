<?php

namespace Skoro\AdminPack\Console;

use Skoro\AdminPack\Facades\Option;
use Illuminate\Console\Command;

class OptionGet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:get {key : Option key}';

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
        $key = $this->argument('key');
        $value = Option::get($key, null);

        if ($value === null) {
            $this->error("Option '$key' value not found.");
        } else {
            $this->info($value);
        }
    }
}
