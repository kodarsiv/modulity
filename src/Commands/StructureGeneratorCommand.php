<?php

namespace Kodarsiv\Modulity\Commands;

use Illuminate\Console\Command;
use Kodarsiv\Modulity\Generators\StructureGenerator;

class StructureGeneratorCommand extends Command
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
        # get arguments
        $moduleName = $this->argument('module');

        $bar = $this->output->createProgressBar(2);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        $generator = new StructureGenerator($moduleName);
        $generator->make();

        $bar->setMessage("Module: {".$moduleName."} has been generated!");
        $bar->finish();
        $bar->clear();
    }
}
