<?php

namespace WeDevBr\IdWall\Http;

use \Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class BaseClient
{
    /** @var ?string */
    public ?string $api_url;

    /** @var ?string */
    private ?string $token;

    public function __construct()
    {
        // Default API is v2
        $this->api_url = config('idwall')['api_v2_url'];
        $this->token = config('idwall')['auth_v2_token'];
    }

    public function useV3Api()
    {
        $this->api_url = config('idwall')['api_v3_url'];
        $this->token = config('idwall')['auth_v3_token'];
    }

    public function useV2Api()
    {
        $this->api_url = config('idwall')['api_v2_url'];
        $this->token = config('idwall')['auth_v2_token'];
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setApiUrl(string $url): self
    {
        $this->api_url = $url;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiUrl(): string|null
    {
        return $this->api_url;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;
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
    protected function post(string $endpoint, array $body = null, array $query = null)
    {
        $request = $this->getHttpClient();

        if ($query) {
            $query = Arr::query($query);
            $endpoint = Str::of("$endpoint?")->append($query);
        }

        return $request->post($this->getFinalUrl($endpoint), $body)
            ->throw()
            ->json();
    }
    protected function getFinalUrl(string $endpoint): string
    {
        $characters = " \t\n\r\0\x0B/";
        return rtrim($this->getApiUrl(), $characters) . "/" . ltrim($endpoint, $characters);
    }

    /**
     * @param string $endpoint
     * @param array|null $body
     * @param array|null $query
     * @return array|mixed
     * @throws RequestException
     */
    protected function put(string $endpoint, array $body = null, array $query = null)
    {
        $request = $this->getHttpClient();

        if ($query) {
            $query = Arr::query($query);
            $endpoint = Str::of("$endpoint?")->append($query);
        }

        return $request->put($this->getFinalUrl($endpoint), $body)
            ->throw()
            ->json();
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
