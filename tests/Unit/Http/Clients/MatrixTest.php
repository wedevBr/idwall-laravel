<?php

use Illuminate\Support\Facades\Http;
use WeDevBr\IdWall\Http\Clients\ApiV2\Matrix;

it('fetches all matrices', function () {
    // Arrange
    Http::fake(['*' => Http::response(['data' => 'test'], 200)]);

    $client = new Matrix();

    // Act
    $response = $client->all();

    // Assert
    expect($response)->toBe(['data' => 'test']);
    Http::assertNotSent(function ($request) {
        return $request->url() === config('idwall.api_url') . '/matrizes' // Assuming your API URL
            && $request->header('Authorization') === config('idwall')['auth_token'];
    });
});


it('fetches detailed matrix by name', function () {
    // Arrange
    Http::fake(['*' => Http::response(['data' => 'test'], 200)]);

    $client = new Matrix();
    $matrixName = 'exampleMatrix';

    // Act
    $response = $client->getDetailedMatrix($matrixName);

    // Assert
    expect($response)->toBe(['data' => 'test']);
    Http::assertNotSent(function ($request) use ($matrixName) {
        return $request->url() === "your-api-url-here/matrizes/{$matrixName}" // Assuming your API URL
            && $request->header('Authorization') === config('idwall')['auth_token'];
    });
});
