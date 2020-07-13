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

        $options = array_map(function ($name) use ($optionRepository) {
            return [
                'name' => $name,
                'value' => $optionRepository->get($name),
            ];
        }, $optionRepository->all());

        $this->table($headers, $options);
    }
}
