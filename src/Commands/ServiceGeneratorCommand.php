<?php

namespace Kodarsiv\Modulity\Commands;

use Exception;
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

        $bar = $this->output->createProgressBar(1);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        try {
            $generator = new ServiceGenerator(
                moduleName: $moduleName,
                filename: $serviceName
            );
            $generator->make();
        }catch (Exception $e){
            $bar->finish();
            $bar->clear();
            $this->error($e->getMessage());
            return;
        }

        $bar->finish();
        $bar->clear();

        $this->info("Service has been generated !");
    }
}
