<?php

namespace Kodarsiv\Modulity;

use Symfony\Component\Yaml\Yaml;
class Parser
{
    public function parseYML(string $YmlUrl): array
    {
        return Yaml::parse(file_get_contents($YmlUrl));
    }
}
