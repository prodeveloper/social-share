<?php

namespace Chencha\Share\Exceptions;

class ServiceNotSupportedException extends \Exception
{
    public function __construct($serviceId, array $supportedServices)
    {
        $message = "`{$serviceId}` is not supported, supported services are: " . implode(', ', $supportedServices);

        parent::__construct($message);
    }
}
