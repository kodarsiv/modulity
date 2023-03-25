<?php

namespace Kodarsiv\Modulity\Commands;

use Exception;
use Illuminate\Console\Command;
use Kodarsiv\Modulity\Generators\RepositoryGenerator;
use Kodarsiv\Modulity\Generators\ServiceGenerator;
use Kodarsiv\Modulity\Generators\StructureGenerator;

class RepositoryGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'modulity:repository {module} {repository}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A command for create new repository file';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        # get arguments
        $moduleName = $this->argument('module');
        $repositoryName = $this->argument('repository');

        $bar = $this->output->createProgressBar(1);
        $bar->setFormat('Progress: %current%/%max% -> <info>%message%</info>');
        $bar->setMessage('Start Generating!');
        $bar->start();

        try {
            $generator = new RepositoryGenerator(
                moduleName: $moduleName,
                filename: $repositoryName
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

        $this->info("Repository has been generated !");
    }
}
