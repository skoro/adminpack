<?php

namespace Skoro\AdminPack\Console;

use Skoro\AdminPack\Facades\Option;
use Illuminate\Console\Command;

class OptionDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:delete {key : Option key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete the option';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $key = $this->argument('key');

        if (Option::remove($key)) {
            $this->info("Option '$key' has been deleted.");
        } else {
            $this->error("Couldn't delete option '$key'.");
        }
    }
}
