<?php

namespace WeDevBr\IdWall\Tests;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class GlobalStubs
{
    /**
     * @return PromiseInterface
     */
    final static public function getAllBusinessResponse() : PromiseInterface
    {
        return Http::response(
            [
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
            ],
            Response::HTTP_OK
        );
    }

    final static public function getSingleBusiness() : PromiseInterface
    {
        return Http::response(
            [
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
            ]
        );
    }

    final static public function unauthenticated() : PromiseInterface
    {
        return Http::response(
          [
              'error' => "Unauthorized",
              'message' => "Falha na autenticação. Por favor verifique o token utilizado e se o acesso foi liberado.",
              'status_code' => Response::HTTP_NOT_FOUND,
          ],
            Response::HTTP_NOT_FOUND
        );
    }
}
