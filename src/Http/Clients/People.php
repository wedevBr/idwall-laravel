<?php

namespace WeDevBr\IdWall\Http\Clients;

use Illuminate\Http\Client\RequestException;
use WeDevBr\IdWall\Http\BaseClient;

class People extends BaseClient
{
    /**
     * @param int $pageNumber
     * @param int $limit
     * @param array $filter
     * @param string|null $orderBy
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/listing-people
     */
    public function all(int $pageNumber = 1, int $limit = 25, array $filter = [], string $orderBy = null): mixed
    {
        $query = array_merge($filter, ['page' => $pageNumber, 'rows' => $limit]);
        if ($orderBy) {
            $query['sort'] = $orderBy;
        }
        return $this->get('/pessoas', $query);
    }

    /**
     * @param string $nifNumber
     * @param int $pageNumber
     * @param int $limit
     * @return mixed
     * @throws RequestException
     * @see https://docs.idwall.co/docs/detailing-people
     */
    public function getDetailedPerson(string $nifNumber, int $pageNumber = 1, int $limit = 25): mixed
    {
        $query = ['page' => $pageNumber, 'rows' => $limit];
        return $this->get("/pessoas/{$nifNumber}", $query);
    }
}
