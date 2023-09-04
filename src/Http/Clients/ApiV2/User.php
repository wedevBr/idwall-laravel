<?php

namespace WeDevBr\IdWall\Http\Clients\ApiV2;

use Illuminate\Http\Client\RequestException;
use WeDevBr\IdWall\Http\BaseClient;

class User extends BaseClient
{
    /**
     * Please, use this endpoint carefully. DO NOT EXPOSE SENSITIVE INFORMATION
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/checking-user-information
     */
    public function all(): mixed
    {
        return $this->get('/usuarios');
    }
}
