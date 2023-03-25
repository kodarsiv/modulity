<?php

namespace Kodarsiv\Modulity\Generators;

use Exception;
use Illuminate\Support\Facades\File;
use Kodarsiv\Modulity\Contracts\GeneratorInterface;
use Kodarsiv\Modulity\Exceptions\FileAlreadyExistException;

class ControllerGenerator implements GeneratorInterface {

    public string $moduleName;
    public string $fileName;
    private bool $completed;

    /**
     * @throws Exception
     */
    public function __construct(string $moduleName, string $filename)
    {
        $this->moduleName = $moduleName;
        $this->fileName = $filename;

        if ( !File::isDirectory(config('modulity.module_path')) ){
            throw new Exception('module not exist!');
        }

        $this->setCompleted(false);
    }

    /**
     * @return $this
     * @throws FileAlreadyExistException|Exception
     */
    public function make(): self
    {

        $path = config('modulity.module_path').DIRECTORY_SEPARATOR.$this->moduleName.DIRECTORY_SEPARATOR."Controllers";

        try {
            $fileGenerator = new FileGenerator();
            $fileGenerator->setType(FileGenerator::TYPE_CONTROLLERS);
            $fileGenerator->setFilename($this->fileName);
            $fileGenerator->setPath($path);

            $fileGenerator->make();
        }catch (Exception $exception){
            throw $exception;
        }


        try {

            if ( !$fileGenerator->isCompleted() ){
                throw new Exception('File Cannot created!');
            }

            $templatePath = __DIR__.'/../../templates/';
            view()->addNamespace('modulity_templates', $templatePath);

            $data = [
                'phpTagStart' => '<?php',
                'namespace' => config('modulity.namespace') ."\\".$this->moduleName. '\\Controllers',
                'className' => $this->fileName . 'Controller',
                'type' => 'class',
                'extendsClassName' => "Controller",
                "extendsClassNameSpace" => "App\Http\Controllers\Controller"
            ];

            $rendered = view('modulity_templates::template')->with($data)->render();

            File::replace($fileGenerator->getFilePath(), $rendered);

        }catch (Exception $exception){
            throw $exception;
        }

        $this->setCompleted(true);

        return $this;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function isCompleted():bool
    {
        return $this->completed;
    }
}
