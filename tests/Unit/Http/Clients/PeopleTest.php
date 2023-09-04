<?php

use Illuminate\Support\Facades\Http;
use WeDevBr\IdWall\Http\Clients\ApiV2\People;

it('fetches all people', function () {
    // Arrange
    Http::fake(['*' => Http::response(['data' => 'test'], 200)]);

    $client = new People();
    $pageNumber = 1;
    $limit = 25;
    $filter = ['key' => 'value'];
    $orderBy = 'name';

    // Act
    $response = $client->all($pageNumber, $limit, $filter, $orderBy);

    // Assert
    expect($response)->toBe(['data' => 'test']);
    Http::assertNotSent(function ($request) use ($filter, $pageNumber, $limit, $orderBy) {
        return $request->url() === config('idwall.api_url') . '/pessoas' // Assuming your API URL
            && $request->hasHeader('Authorization', config('idwall')['auth_token'])
            && $request['page'] === $pageNumber
            && $request['rows'] === $limit
            && $request['sort'] === $orderBy
            && $request['key'] === $filter['key'];
    });
});

it('fetches detailed person by NIF number', function () {
    // Arrange
    Http::fake(['*' => Http::response(['data' => 'test'], 200)]);

    $client = new People();
    $nifNumber = '12345';
    $pageNumber = 1;
    $limit = 25;

    // Act
    $response = $client->getDetailedPerson($nifNumber, $pageNumber, $limit);

    // Assert
    expect($response)->toBe(['data' => 'test']);
    Http::assertNotSent(function ($request) use ($nifNumber, $pageNumber, $limit) {
        return $request->url() === config('idwall.api_url') . "/pessoas/{$nifNumber}" // Assuming your API URL
            && $request->header('Authorization') === config('idwall')['auth_token']
            && $request['page'] === $pageNumber
            && $request['rows'] === $limit;
    });
});
