<?php

namespace Kodarsiv\Modulity\Generators;

use Kodarsiv\Modulity\Contracts\GeneratorInterface;

class StructureGenerator implements GeneratorInterface {

    private bool $completed;

    public function __construct()
    {
        $this->setCompleted(false);
    }


    public function make(): self
    {
        // implementation waiting..
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
