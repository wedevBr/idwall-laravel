<?php

use WeDevBr\IdWall\IdWall;
use WeDevBr\IdWall\Http\Clients\Business;
use WeDevBr\IdWall\Http\Clients\Matrix;
use WeDevBr\IdWall\Http\Clients\People;
use WeDevBr\IdWall\Http\Clients\Report;
use WeDevBr\IdWall\Http\Clients\User;

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
