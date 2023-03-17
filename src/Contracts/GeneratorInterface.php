<?php

namespace Kodarsiv\Modulity\Contracts;

/**
 * @version: 1.0.0
 *
 * @author : Taner Tombas <tombastaner@gmail.com>
 * @since: 1.0.1
 *
 * This contract has been created to be usable for the future generations of generators that we will develop.
 * Therefore, it is necessary to use this contract in all generator classes that will be created.
 * The system will initialize these classes through this interface
 *
 *
**/
interface GeneratorInterface {
    public function make(): self;
    public function isCompleted():bool;
}
