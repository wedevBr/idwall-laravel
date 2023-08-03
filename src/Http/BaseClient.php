<?php

namespace WeDevBr\IdWall\Http;

use \Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class BaseClient
{
    /** @var ?string */
    public ?string $api_url;

    /** @var ?string */
    private ?string $token;

    public function __construct()
    {
        $this->api_url = config('idwall')['api_url'];
        $this->token = config('idwall')['auth_token'];
    }

    public function getToken(): string|null
    {
        return $this->token;
    }

    /**
     * @throws RequestException
     */
    protected function get(string $endpoint, array|string|null $query = null, $responseJson = true)
    {
        $request = $this->getHttpClient()->get($this->getFinalUrl($endpoint), $query)->throw();

        return ($responseJson) ? $request->json() : $request;
    }

    /**
     * @throws RequestException
     */
    protected function post(string $endpoint, array $body = null)
    {
        $request = $this->getHttpClient();

        return $request->post($this->getFinalUrl($endpoint), $body)
            ->throw()
            ->json();
    }
    protected function getFinalUrl(string $endpoint): string
    {
        $characters = " \t\n\r\0\x0B/";
        return rtrim($this->api_url, $characters) . "/" . ltrim($endpoint, $characters);
    }

    private function getHttpClient(): PendingRequest
    {
        return Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => $this->getToken(),
        ]);
    }
}
