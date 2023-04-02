<?php
namespace Kodarsiv\Modulity\Tests;

use Exception;
use Illuminate\Support\Facades\File;
use Kodarsiv\Modulity\Exceptions\FileAlreadyExistException;
use Kodarsiv\Modulity\Generators\ControllerGenerator;
use Kodarsiv\Modulity\Generators\StructureGenerator;
use Tests\TestCase;

class ModulityControllerCreateTest extends TestCase
{
    private string $moduleName;
    private string $fileName;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName  = "Test";
        $this->fileName  = "Example";

        $structureGenerator = new StructureGenerator($this->moduleName);
        $structureGenerator->make();

    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if (File::isDirectory(app_path('Modules/'.ucfirst($this->moduleName)))) {
            File::deleteDirectory(app_path('Modules/'.ucfirst($this->moduleName)));
        }
    }

    /**
     * @test
     *
     * This test creates a service class by calling the `$this->generate()` method and checks
     * whether the created class exists in the file system.
     *
     * The test doesn't contain a try-catch block because the `assertTrue()`
     * method throws an exception if the file doesn't exist.
     * We create the path to the service file using the `config()` method,
     * and then check the existence of the file path using the `file_exists()` method.
     * If the file exists, the test passes. If the file doesn't exist, the test fails.
     *
     * @throws Exception
     */
    public function crate_controller_test(): void
    {
        $this->generate();
        $filePath = config('modulity.module_path') . '/' .
            ucfirst($this->moduleName) . '/Controllers/' . ucfirst($this->fileName)."Controller.php";
        $this->assertTrue(file_exists($filePath), 'Controller file should exist.');
    }


    /**
     * @test
     *
     * @throws Exception
     */
    public function controller_already_exist_test(): void
    {
        $this->generate();
        try {
            $this->generate();
            $this->fail("The program is expected to throw a FileAlreadyExistException when attempting to create a file that already exists.");
        }catch (Exception $exception) {
            $this->assertTrue($exception instanceof FileAlreadyExistException);
        }
    }



    /**
     * @throws Exception
     */
    private function generate(){
        try {
            $generator = new ControllerGenerator($this->moduleName, $this->fileName);
            $generator->make();

        }catch (Exception $exception){
            throw $exception;
        }
    }
}
