<?php

namespace Kodarsiv\Modulity\Commands;

use Illuminate\Console\Command;
use Kodarsiv\Modulity\Generators\ServiceGenerator;
use Kodarsiv\Modulity\Generators\StructureGenerator;

class ServiceGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modulity:service {module} {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command for create new service file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        # get arguments
        $moduleName = $this->argument('module');
        $serviceName = $this->argument('service');

        $bar = $this->output->createProgressBar(2);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        $generator = new ServiceGenerator(
            moduleName: $moduleName,
            filename: $serviceName
        );

        $generator->make();

        $bar->setMessage("Module: {".$moduleName."} has been generated!");
        $bar->finish();
        $bar->clear();
    }
}
