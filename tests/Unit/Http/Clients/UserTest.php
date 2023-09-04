<?php

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use WeDevBr\IdWall\Http\Clients\ApiV2\User;

it('can get all users', function () {
    Http::fake(['*/usuarios' => Http::response(['users' => 'data'], 200)]);
    $client = new User();
    $response = $client->all();
    expect($response)->toBe(['users' => 'data']);
});

it('throws request exception on failure when getting all users', function () {
    Http::fake(['*/usuarios' => Http::response([], 500)]);
    $client = new User();
    expect(fn() => $client->all())->toThrow(RequestException::class);
});
