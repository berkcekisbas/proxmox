<?php

namespace Berk\Proxmox\Exceptions;

namespace Berk\Proxmox\Exceptions;

use Exception;

class ProxmoxException extends Exception
{
    public function __construct($message = "Proxmox API error", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
