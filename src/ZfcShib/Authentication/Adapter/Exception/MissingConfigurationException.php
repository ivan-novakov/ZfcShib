<?php

namespace ZfcShib\Authentication\Adapter\Exception;


class MissingConfigurationException extends \RuntimeException
{


    public function __construct($configName)
    {
        parent::__construct(sprintf("Missing configuration directive '%s'", $configName));
    }
}