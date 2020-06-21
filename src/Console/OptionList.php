<?php

namespace Skoro\AdminPack\Console;

use Skoro\AdminPack\Facades\Option;
use Illuminate\Console\Command;

class OptionList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show available options and their values';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $headers = ['Key', 'Value'];

        $options = Option::all(['key', 'value'])->toArray();

        $this->table($headers, $options);
    }
}
