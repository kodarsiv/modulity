<?php

namespace Kodarsiv\Modulity\Generators;

use Exception;
use Illuminate\Support\Facades\File;
use Kodarsiv\Modulity\Contracts\GeneratorInterface;
use Kodarsiv\Modulity\Exceptions\FileAlreadyExistException;

class FileGenerator implements GeneratorInterface
{

    public const TYPE_REPOSITORY = 'repository';
    public const TYPE_SERVICE = 'service';
    public const TYPE_CONTROLLERS = 'controller';

    private bool $completed;
    private string $type;
    private string $filename;
    private string $path;
    private string $filePath;

    public function __construct()
    {
        $this->type = "";
        $this->filename = "";
        $this->path = "";

        $this->setCompleted(false);
    }

    /**
     * @return GeneratorInterface
     * @throws FileAlreadyExistException|Exception
     */
    public function make(): GeneratorInterface
    {
        if ( !File::isDirectory($this->path) ){
            throw new Exception($this->type." path not exist!");
        }

        $this->setFilePath($this->path.DIRECTORY_SEPARATOR.ucfirst($this->filename).ucfirst($this->type).".php");
        if ( File::isFile($this->filePath) ) {
            throw new FileAlreadyExistException($this->filename.ucfirst($this->type));
        }

        touch($this->filePath);

        $this->setCompleted(true);

        return $this;
    }

    /**
     * @return bool
     *
     **/
    public function isCompleted(): bool
    {
        return $this->completed;
    }

    /**
     * @param bool $completed
     * @return $this
     **/
    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @param string $type
     * @return FileGenerator
     */
    public function setType(string $type): FileGenerator
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $filename
     * @return FileGenerator
     */
    public function setFilename(string $filename): FileGenerator
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @param string $path
     * @return FileGenerator
     */
    public function setPath(string $path): FileGenerator
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $filePath
     * @return FileGenerator
     */
    public function setFilePath(string $filePath): FileGenerator
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return $this->filePath;
    }

}
