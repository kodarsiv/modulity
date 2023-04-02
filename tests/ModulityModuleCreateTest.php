<?php
namespace Kodarsiv\Modulity\Tests;

use Exception;
use Kodarsiv\Modulity\Exceptions\ModuleAlreadyExistException;
use Kodarsiv\Modulity\Generators\StructureGenerator;
use Tests\TestCase;

class ModulityModuleCreateTest extends TestCase
{
    private string $moduleName;
    protected function setUp(): void
    {
        parent::setUp();
        $this->moduleName  = "Test";
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        if (\File::isDirectory(app_path('Modules/'.ucfirst($this->moduleName)))) {
            \File::deleteDirectory(app_path('Modules/'.ucfirst($this->moduleName)));
        }
    }

    /**
     * @test
     *
     * This test checks whether the module creation process is successful or not.
     * The test creates a module by calling the generateModule() method and checks for
     * the existence of the module's folder.
     *
     * The test is contained within a try-catch block. In the try block,
     * the generateModule() method is called to create a module.
     * Then, the existence of the created module's folder is checked using the isDirectory() method.
     * If the module folder exists, the test passes. If the module folder doesn't exist, the test fails.
     *
     * The catch block displays the exception message in case of test failure.
     *
     * @throws Exception
     */
    public function structure_crate_module(): void
    {
        try {
            $this->generateModule();

            if ( \File::isDirectory(app_path('Modules/'.ucfirst($this->moduleName)))) {
                $this->assertTrue(true);
            }else{
                $this->fail();
            }
        }catch (Exception $exception){
            $this->fail($exception->getMessage());
        }
    }

    /**
     * @test
     *
     * This test checks whether a module with the same name already exists during the module creation process.
     * The test creates a module and attempts to create another module with the same name.
     * The second module creation attempt should trigger the ModuleAlreadyExistException exception.
     * The test is contained within a try-catch block.
     *
     * In the try block, the generateModule() method is called twice.
     * The first call successfully creates a module.
     * The second call attempts to create a module with the same name, which triggers the
     * ModuleAlreadyExistException exception.
     *
     * The catch block catches the ModuleAlreadyExistException exception and checks whether the exception type is
     * correct for the test to pass. If a ModuleAlreadyExistException exception is thrown, the test
     * completes successfully. If another exception is thrown or no exception is thrown at all, the test fails.
     *
     * @throws Exception
     */
    public function structure_module_already_exist(): void
    {
        $this->generateModule();
        try {
            $this->generateModule();
            $this->fail();
        }catch (Exception $exception){
            $this->assertTrue($exception instanceof ModuleAlreadyExistException);
        }
    }


    /**
     * @throws Exception
     */
    private function generateModule(){
        try {
            $generator = new StructureGenerator($this->moduleName);
            $generator->make();
        }catch (Exception $exception){
            throw $exception;
        }
    }
}
