<?php

namespace Skoro\AdminPack\Console;

use Illuminate\Console\Command;
use Skoro\AdminPack\Repositories\OptionRepository;

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
    public function handle(OptionRepository $optionRepository)
    {
        $headers = ['Name', 'Value'];

        $options = $optionRepository->all()->map(function ($option) {
            return [
                'name' => $option->name,
                'value' => $option->value,
            ];
        });

        $this->table($headers, $options);
    }
}
