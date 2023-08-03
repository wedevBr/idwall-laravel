<?php

namespace WeDevBr\IdWall\Http\Clients;

use Illuminate\Http\Client\RequestException;
use WeDevBr\IdWall\Http\BaseClient;

class Business extends BaseClient
{
    /**
     * @param int $pageNumber
     * @param int $limit
     * @param array $filter
     * @param string|null $orderBy
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/listar-empresas
     */
    public function all(int $pageNumber = 1, int $limit = 25, array $filter = [], string $orderBy = null): mixed
    {
        $query = array_merge($filter, ['page' => $pageNumber, 'rows' => $limit]);
        if ($orderBy) {
            $query['sort'] = $orderBy;
        }
        return $this->get('/empresas', $query);
    }

    /**
     * @param string $nifNumber
     * @param int $pageNumber
     * @param int $limit
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/detalhando-empresas
     */
    public function getDetailedBusiness(string $nifNumber, int $pageNumber = 1, int $limit = 25): mixed
    {
        $query = ['page' => $pageNumber, 'rows' => $limit];
        return $this->get("/empresas/{$nifNumber}", $query);
    }
}
