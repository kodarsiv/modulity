<?php

namespace Kodarsiv\Modulity\Contracts;


interface GeneratorsInterface {

    function make():self;

    function isComplete():bool;
}
