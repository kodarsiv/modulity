<?php

namespace Kodarsiv\Modulity\Commands;

use Exception;
use Illuminate\Console\Command;
use Kodarsiv\Modulity\Generators\ProviderGenerator;

class ProviderGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modulity:provider {module} {provider}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command for create new provider file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        # get arguments
        $moduleName = $this->argument('module');
        $fileName = $this->argument('provider');

        $bar = $this->output->createProgressBar(1);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        try {
            $generator = new ProviderGenerator(
                moduleName: $moduleName,
                filename: $fileName
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

        $this->info("Provider has been generated !");
    }
}
