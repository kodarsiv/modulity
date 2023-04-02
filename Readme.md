# Modulity: A PHP Package for Modular Design

Modulity is a modular design package designed specifically for API developers in PHP. 
It can be easily integrated into the Laravel framework and is designed to reduce repetitive tasks during project development. 
Modulity allows you to create new modules, service and repository layers, and manage modules in your project.

Modulity provides an easy-to-use CLI (command-line interface) that allows you to perform tasks such as creating a new module, 
service, or repository quickly and easily. In addition, Modulity is integrated with Artisan,
making it easy to run Modulity commands as Artisan commands.

## Installation
To start using the Modulity package, you must first install the package via Composer. 
Use the following command in the terminal to install the package:

```shell
composer require tanerincode/modulity
```
After this process, you need to publish the configuration file :
```shell
php artisan vendor:publish --provider="Kodarsiv\Modulity\Providers\ModulityServiceProvider" --tag=modulity-config
```

## Available Commands

**Module :** _Creates a new module structure with the given name._
```shell
php artisan modulity:make {moduleName}
```

**Service :** _Creates a new Service file for an existing module.
Here, ServiceName is enough. Do not write `Service` at the end._
```shell
php artisan modulity:service {moduleName} {ServiceName}
```

**Repository :** _Creates a new Repository file for an existing module.
Here, RepositoryName is enough. Do not write `Repository` at the end._
```shell
php artisan modulity:repository {moduleName} {RepositoryName}
```

**Controller :** _Creates a new Controller file for an existing module.
Here, ControllerName is enough. Do not write `Controller` at the end._
```shell
php artisan modulity:controller {moduleName} {ControllerName}
```
