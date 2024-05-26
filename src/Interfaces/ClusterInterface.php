<?php

namespace Berk\Proxmox\Interfaces;

interface ClusterInterface
{
    public function resources($data);
    public function log();
    public function nextId();
    public function options();
    public function status();
    public function tasks();
}
