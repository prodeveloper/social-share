<?php

namespace Chencha\Share\Exceptions;

class NoServiceIsAvailable extends \Exception
{
    public function __construct()
    {
        parent::__construct("No service is found in config file");
    }
}
