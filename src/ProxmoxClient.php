<?php

namespace Berk\Proxmox;

use Berk\Proxmox\Api\Node;
use Berk\Proxmox\Exceptions\ProxmoxException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

/**
 * @method getVms($node)
 */
class ProxmoxClient
{
    protected $client;
    protected $apiUrl;
    protected $tokenId;
    protected $apiToken;
    protected $headers;
    protected $options;

    public function __construct()
    {
        $this->apiUrl = config('proxmox.api_url');
        $this->tokenId = config('proxmox.token_id');
        $this->apiToken = config('proxmox.api_token');
        $this->headers = [
            'Authorization' => "PVEAPIToken=" . $this->tokenId . "=" . $this->apiToken,
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ];
        $this->options = [
            'verify' => false
        ];
    }

    /**
     * @throws ProxmoxException
     */
    public function request(string $method, string $path, array $data = [])
    {
        try {
            $request = Http::withHeaders($this->headers)
                ->withOptions($this->options);

            $request = $request->$method($this->apiUrl . $path, $data);

            if ($request->failed()) {
                throw new ProxmoxException("Request error: " . $request->getReasonPhrase());
            }

            return $request->json();

        } catch (\Exception $e){
            if ($e->getCode() === 401) {
                throw new ProxmoxException("Unauthorized access");
            }

            throw new ProxmoxException("Request error: " . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
