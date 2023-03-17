<?php

namespace Kodarsiv\Modulity\Commands;

use Illuminate\Console\Command;

class StructureGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modulity:make {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Modulity : will create a module structure';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $bar = $this->output->createProgressBar(6);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        // TODO :: The commands for creating classes will come here

        $bar->setMessage("");
        $bar->finish();
        $bar->clear();
    }
}
