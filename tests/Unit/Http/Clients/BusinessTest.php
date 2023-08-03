<?php

use Illuminate\Http\Client\RequestException;
use Symfony\Component\HttpFoundation\Response;
use WeDevBr\IdWall\Http\Clients\Business;
use Illuminate\Support\Facades\Http;
use WeDevBr\IdWall\Tests\GlobalStubs;

it('retrieves all businesses', function () {

    Http::fake(
        [
            '*' => GlobalStubs::getAllBusinessResponse()
        ]
    );

    // Arrange

    $client = new Business();
    $pageNumber = 1;
    $limit = 25;
    $filter['cnpj'] = '12345678910111';

    // Act
    $response = $client->all($pageNumber, $limit, $filter, 'name');

    // Assert
    expect($response)->toBe([
        "result" => [
            "busca" => "",
            "itens" => [
                [
                    "cnpj" => "12345678910111",
                    "nome" => "Nome Empresa A",
                    "atualizado_em" => "2020-06-08T21:31:18.391Z",
                ],
                [
                    "cnpj" => "98765432110111",
                    "nome" => "Nome Empresa B",
                    "atualizado_em" => "2020-06-08T21:29:56.041Z",
                ],
                [
                    "cnpj" => "12365478901111",
                    "nome" => "Nome Empresa C",
                    "atualizado_em" => "2020-06-08T21:28:10.723Z",
                ],
                [
                    "cnpj" => "32145698710111",
                    "nome" => "Nome Empresa D",
                    "atualizado_em" => "2020-06-08T21:28:06.562Z",
                ],
            ],
            "paginacao" => [
                "atual" => 1,
                "linhas" => 25,
                "total" => "4",
            ],
        ],
        "status_code" => 200,
    ]);

    Http::assertNotSent(function ($request) {
        return $request->url() === config('idwall.api_url') . '/empresas'
            && $request->header('Authorization') === config('idwall')['auth_token']
            && $request['status'] === 'active'
            && $request['page'] === 1
            && $request['rows'] === 25
            && $request['sort'] === 'name';
    });
});

it('retrieves detailed business by nifNumber', function () {
    // Arrange
    $nifNumber = '123456';
    Http::fake(
        [
            "*" => GlobalStubs::getSingleBusiness()
        ]
    );
    $client = new Business();
    $pageNumber = 1;
    $limit = 25;

    // Act
    $response = $client->getDetailedBusiness($nifNumber, $pageNumber, $limit);

    // Assert
    expect($response)->toBe([
        "result" => [
            "dados" => [
                "cnpj" => "12345678910111",
                "nome" => "Empresa A",
                "atualizado_em" => "2020-06-08T15:32:22.598Z",
                "relatorios" => [
                    [
                        "numero" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx",
                        "status" => "CONCLUIDO",
                        "nome" => "nome_da_configuração",
                        "mensagem" => "",
                        "resultado" => "INVALID",
                        "atualizado_em" => "2020-06-08T15:32:22.598Z",
                    ],
                    [
                        "numero" => "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxx",
                        "status" => "CONCLUIDO",
                        "nome" => "nome_da_configuração",
                        "mensagem" => "",
                        "resultado" => "VALID",
                        "atualizado_em" => "2020-06-03T07:00:29.489Z",
                    ],
                ],
            ],
            "paginacao" => [
                "atual" => 1,
                "linhas" => 25,
                "total" => "1",
            ],
        ],
        "status_code" => 200,
    ]);

    Http::assertNotSent(function ($request) use ($nifNumber) {
        return $request->url() === config('idwall.api_url') . "/empresas/{$nifNumber}"
            && $request->header('Authorization') === config('idwall')['auth_token']
            && $request['page'] === 1
            && $request['rows'] === 25;
    });
});

it('retrieves fails and throws exception', function () {
    // Arrange
    $nifNumber = '123456';
    Http::fake(
        [
            "*" => GlobalStubs::unauthenticated()
        ]
    );
    $client = new Business();
    $pageNumber = 1;
    $limit = 25;

    // Act
    $response = $client->getDetailedBusiness($nifNumber, $pageNumber, $limit);
    expect($response)
        ->toBe([
            'error' => "Unauthorized",
            'message' => "Falha na autenticação. Por favor verifique o token utilizado e se o acesso foi liberado.",
            'status_code' => Response::HTTP_NOT_FOUND,
        ]);

})->throws(RequestException::class);

