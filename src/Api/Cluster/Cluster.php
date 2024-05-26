<?php

namespace Berk\Proxmox\Api\Cluster;

use Berk\Proxmox\Exceptions\ProxmoxException;
use Berk\Proxmox\Interfaces\ClusterInterface;
use Berk\Proxmox\ProxmoxClient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Cluster extends ProxmoxClient implements ClusterInterface
{
    protected string $path = "cluster/";

    /**
     * @throws ProxmoxException
     */
    public function resources($data)
    {
        $validator = Validator::make($data, [
            'type' => [
                'nullable',Rule::in(["vm","storage","node","sdn"])
            ],
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->all());
        }

        return $this->request("GET",$this->path."resources",['type' => $data['type']]);
    }

    /**
     * @throws ProxmoxException
     */
    public function log()
    {
        return $this->request("GET",$this->path."log");
    }

    /**
     * @throws ProxmoxException
     */
    public function nextId()
    {
        return $this->request("GET",$this->path."nextid");
    }

    /**
     * @throws ProxmoxException
     */
    public function options()
    {
        return $this->request("GET",$this->path."options");
    }

    /**
     * @throws ProxmoxException
     */
    public function status()
    {
        return $this->request("GET",$this->path."status");
    }

    /**
     * @throws ProxmoxException
     */
    public function tasks()
    {
        return $this->request("GET",$this->path."tasks");
    }
}
