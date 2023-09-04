<?php

use WeDevBr\IdWall\Http\Clients\ApiV2\Business;
use WeDevBr\IdWall\Http\Clients\ApiV2\Matrix;
use WeDevBr\IdWall\Http\Clients\ApiV2\People;
use WeDevBr\IdWall\Http\Clients\ApiV2\Report;
use WeDevBr\IdWall\Http\Clients\ApiV2\User;
use WeDevBr\IdWall\Http\Clients\ApiV3\Profile;
use WeDevBr\IdWall\IdWall;

it('can create a business client', function () {
    $idWall = new IdWall();
    $client = $idWall->clientBusiness();
    expect($client)->toBeInstanceOf(Business::class);
});

it('can create a matrix client', function () {
    $idWall = new IdWall();
    $client = $idWall->clientMatrix();
    expect($client)->toBeInstanceOf(Matrix::class);
});

it('can create a people client', function () {
    $idWall = new IdWall();
    $client = $idWall->clientPeople();
    expect($client)->toBeInstanceOf(People::class);
});

it('can create a report client', function () {
    $idWall = new IdWall();
    $client = $idWall->clientReport();
    expect($client)->toBeInstanceOf(Report::class);
});

it('can create a user client', function () {
    $idWall = new IdWall();
    $client = $idWall->clientUser();
    expect($client)->toBeInstanceOf(User::class);
});

it('can create a profile client', function () {
    $idWall = new IdWall();
    $client = $idWall->clientProfile();
    expect($client)->toBeInstanceOf(Profile::class);
});
