<?php

namespace Berk\Proxmox\Api;

use Berk\Proxmox\Exceptions\ProxmoxException;
use Berk\Proxmox\ProxmoxClient;

class Node extends ProxmoxClient
{
    /**
     * @throws ProxmoxException
     */
    public function nodes()
    {
        return $this->request("GET","nodes");
    }

    /**
     * @throws ProxmoxException
     */
    public function node($node)
    {
        return $this->request("GET","nodes/".$node);
    }

    /**
     * @throws ProxmoxException
     */
    public function config($node)
    {
        return $this->request("GET","nodes/".$node."/config");
    }

    /**
     * @throws ProxmoxException
     */
    public function status($node)
    {
        return $this->request("GET","nodes/".$node."/status");
    }
}
