<?php

namespace WeDevBr\IdWall\Http\Clients;

use Illuminate\Http\Client\RequestException;
use WeDevBr\IdWall\Http\BaseClient;

class Matrix extends BaseClient
{
    /**
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/listing-configurations
     */
    public function all(): mixed
    {
        return $this->get('/matrizes');
    }

    /**
     * @param string $matrixName
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/detailing-configurations
     */
    public function getDetailedMatrix(string $matrixName): mixed
    {
        return $this->get("/matrizes/{$matrixName}");
    }
}
