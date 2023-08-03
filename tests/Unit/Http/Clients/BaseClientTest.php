<?php

use Illuminate\Support\Facades\Http;
use WeDevBr\IdWall\Http\BaseClient;

class TestableBaseClient extends BaseClient {
    public function getPublic(string $endpoint, array|string|null $query = null, $responseJson = true) {
        return $this->get($endpoint, $query, $responseJson);
    }

    public function getFinalUrlPublic($endpoint)
    {
        return $this->getFinalUrl($endpoint);
    }

    public function post(string $endpoint, array $body = null)
    {
        return parent::post($endpoint, $body);
    }

}

it('initializes with correct token and API URL', function () {
    // Assuming the configuration for 'idwall' is already set up
    $client = new BaseClient();

    expect($client->api_url)->toBe(config('idwall')['api_url'])
        ->and($client->getToken())->toBe(config('idwall')['auth_token']);
});

it('constructs the final URL correctly', function () {
    $client = new TestableBaseClient();
    $endpoint = 'test-endpoint';

    $finalUrl = $client->getFinalUrlPublic($endpoint);

    expect($finalUrl)->toBe(rtrim(config('idwall')['api_url'], " \t\n\r\0\x0B/") . '/' . ltrim($endpoint, " \t\n\r\0\x0B/"));
});

it('performs a GET request', function () {
    // Arrange
    Http::fake(['*' => Http::response(['foo' => 'bar'], 200)]);

    $client = new TestableBaseClient();
    $endpoint = 'test-endpoint';

    // Act
    $response = $client->getPublic($endpoint);

    // Assert
    expect($response)->toBe(['foo' => 'bar']);
});


it('performs a POST request', function () {
    // Arrange
    Http::fake(['*' => Http::response(['foo' => 'bar'], 200)]);

    $client = new TestableBaseClient();
    $endpoint = 'test-endpoint';
    $body = ['name' => 'test'];

    // Act
    $response = $client->post($endpoint, $body);

    // Assert
    expect($response)->toBe(['foo' => 'bar']);
});
