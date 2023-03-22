<?php

namespace Kodarsiv\Modulity\Generators;

use Illuminate\Support\Facades\File;
use Kodarsiv\Modulity\Contracts\GeneratorInterface;
use Kodarsiv\Modulity\Parser;

class StructureGenerator implements GeneratorInterface {

    public string $moduleName;

    private bool $completed;
    private string $templateYml;
    private array $structure;
    private Parser $parser;

    const TYPE_IS_FOLDER = 'folder';
    const LEVEL_IS_BASE = 'base';



    public function __construct(string $moduleName)
    {
        $this->moduleName = $moduleName;

        if ( !File::isDirectory(config('modulity.module_path')) ){
            File::makeDirectory(config("modulity.module_path"), 0775);
        }

        $this->parser = new Parser();
        $this->setTemplateYml(config('modulity.template'));
        $this->setStructure($this->parser->parseYML($this->templateYml));
        $this->setCompleted(false);
    }


    public function make(): self
    {
        $folders = $this->structure['Folders'];
        $this->eachYmlFile($folders);
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

    public function setTemplateYml(string $templateYml): self
    {
        $this->templateYml = $templateYml  == 'default' ? __DIR__."/../../templates/folders-template.yml": $templateYml;
        return $this;
    }

    /**
     * @return array
     */
    public function getStructure(): array
    {
        return $this->structure;
    }

    /**
     * @param array $structure
     * @return StructureGenerator
     */
    public function setStructure(array $structure): StructureGenerator
    {
        $this->structure = $structure;
        return $this;
    }

    public function eachYmlFile(array $items): void
    {
        foreach ($items as $item) {
            if ( $item['type'] == self::TYPE_IS_FOLDER ){
                $this->create(function () use ($item) {
                    try {
                        $this->createFolders($item);
                        if ( isset($item['files']) ){
                            $this->createFiles($this->createFolderPath($item),$item['files']);
                        }
                    }catch (\Exception $exception){
                        throw new \Exception($exception->getMessage());
                    }
                });
            }
            if ( array_key_exists('children', $item) ){
                $this->eachYmlFile($item['children']);
            }
        }
    }

    private function createFolders($item): void
    {
        $modulePath = config('modulity.module_path')."/".ucfirst($this->moduleName);
        if ( ! File::isDirectory($modulePath) ){
            File::makeDirectory($modulePath, 0775);
        }
        $folderPath = $this->createFolderPath($item);
        if ( ! File::isDirectory($folderPath) ){
            File::makeDirectory($folderPath, 0775);
        }
    }

    private function createFiles(string $path, array $files)
    {
        foreach ($files as $file) {
            $filePath = $path . "/" . $file.".php";

            if ( ! File::isFile($filePath) ) {
                try {
                    touch($filePath);
                    File::put($filePath, "<?php \n\nreturn [\n];");
                } catch (\Exception $e) {
                   // log error
                    throw $e;
                }
            }
        }
    }

    private function createFolderPath($item): string
    {
        $folderPath = config('modulity.module_path')."/".$this->moduleName;
        if ( $item['level'] === self::LEVEL_IS_BASE ){
            $folderPath .= "/".ucfirst($item['name']);
        }else{
            $folderPath .= "/".ucfirst($item["level"])."/";
            if ( strlen($item['name']) <= 2 ) {
                $folderPath .= strtolower($item['name']);
            }else{
                $folderPath .= ucfirst($item['name']);
            }
        }

        return $folderPath;
    }
    public function create(callable $callback)
    {
        $callback();
    }
}
