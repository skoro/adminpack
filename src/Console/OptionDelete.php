<?php

namespace Skoro\AdminPack\Console;

use Illuminate\Console\Command;
use Skoro\AdminPack\Repositories\OptionRepository;

class OptionDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'option:delete {name : Option name}';

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
    public function handle(OptionRepository $optionRepository)
    {
        $name = $this->argument('name');

        if ($optionRepository->delete($name)) {
            $this->info("Option '$name' has been deleted.");
        } else {
            $this->error("Couldn't delete option '$name'.");
        }
    }
}
