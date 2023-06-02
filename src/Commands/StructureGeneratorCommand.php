<?php

namespace Kodarsiv\Modulity\Commands;

use Illuminate\Console\Command;
use Kodarsiv\Modulity\Generators\ControllerGenerator;
use Kodarsiv\Modulity\Generators\RepositoryGenerator;
use Kodarsiv\Modulity\Generators\ServiceGenerator;
use Kodarsiv\Modulity\Generators\StructureGenerator;
use Kodarsiv\Modulity\Generators\ProviderGenerator;

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
     * @throws \Exception
     */
    public function handle(): void
    {
        # get arguments
        $moduleName = $this->argument('module');

        $bar = $this->output->createProgressBar(5);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        try {
            $structure = new StructureGenerator($moduleName);
            $structure->make();
        }catch (\Exception $exception){
            $bar->finish();
            $bar->clear();

            $this->error($exception->getMessage());
        }
        $bar->setMessage('Created Directories!');
        sleep(1);

        try {
            $service = new ServiceGenerator($moduleName, $moduleName);
            $service->make();
        }catch (\Exception $exception){
            $bar->finish();
            $bar->clear();

            $this->error($exception->getMessage());
        }
        $bar->advance();
        $bar->setMessage('Service Created!');
        sleep(1);

        try {
            $service = new RepositoryGenerator($moduleName, $moduleName);
            $service->make();
        }catch (\Exception $exception){
            $bar->finish();
            $bar->clear();

            $this->error($exception->getMessage());
        }
        $bar->advance();
        $bar->setMessage('Repository Created!');
        sleep(1);

        try {
            $service = new ControllerGenerator($moduleName, $moduleName);
            $service->make();
        }catch (\Exception $exception){
            $bar->finish();
            $bar->clear();

            $this->error($exception->getMessage());
        }
        $bar->advance();
        $bar->setMessage('Controller Created!');
        sleep(1);

        try {
            $service = new ProviderGenerator($moduleName, $moduleName);
            $service->make();
        }catch (\Exception $exception){
            $bar->finish();
            $bar->clear();

            $this->error($exception->getMessage());
        }
        $bar->advance();
        $bar->setMessage('Provider Created!');
        sleep(1);

        $bar->finish();
        $bar->clear();
        $this->info("Module: {".$moduleName."} has been generated!");
    }
}
