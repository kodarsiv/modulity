<?php

namespace Kodarsiv\Modulity\Generators;

use Illuminate\Support\Facades\File;
use Kodarsiv\Modulity\Contracts\GeneratorInterface;
use Kodarsiv\Modulity\Exceptions\FileAlreadyExistException;

class ServiceGenerator implements GeneratorInterface {

    public string $moduleName;
    public string $fileName;
    private bool $completed;

    public function __construct(string $moduleName, string $filename)
    {
        $this->moduleName = $moduleName;
        $this->fileName = $filename;

        if ( !File::isDirectory(config('modulity.module_path')) ){
            // todo: throw exception there is no module!
        }

        $this->setCompleted(false);
    }

    /**
     * @return $this
     * @throws FileAlreadyExistException, \Exception
     */
    public function make(): self
    {

        $path = config('modulity.module_path').DIRECTORY_SEPARATOR.$this->moduleName.DIRECTORY_SEPARATOR."Services";
        if ( !File::isDirectory($path) ){
            // todo throw exception services not found!
        }
        $filePath  = $path.DIRECTORY_SEPARATOR.ucfirst($this->fileName)."Service.php";
        if ( File::isFile($filePath) ) {
            throw new FileAlreadyExistException($this->fileName."Service");
        }

        try {
            touch($filePath);
            $templatePath = __DIR__.'/../../templates/';
            view()->addNamespace('modulity_templates', $templatePath);

            $data = [
                'phpTagStart' => '<?php',
                'namespace' => config('modulity.namespace') ."\\".$this->moduleName. '\\Services',
                'className' => $this->fileName . 'Service',
                'type' => 'class'
            ];

            $rendered = view('modulity_templates::template')->with($data)->render();

            File::replace($filePath, $rendered);

        }catch (\Exception $exception){
            throw $exception;
        }

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
