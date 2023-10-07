<?php

namespace WeDevBr\IdWall\Http\Clients\ApiV3;

use Illuminate\Http\Client\RequestException;
use WeDevBr\IdWall\Http\BaseClient;

class Profile extends BaseClient
{

    public function __construct()
    {
        parent::__construct();
        parent::useV3Api();
    }

    /**
     * @param array $data
     * @param ?string $referenceId
     * @return array|mixed
     * @throws RequestException
     * @see https://idwall-maestro.readme.io/reference/create-profile
     */
    public function create(array $data, string $referenceId = null): mixed
    {
        if ($referenceId) {
            $data['ref'] = $referenceId;
        }
        return $this->post('/profile', $data);
    }

    /**
     * @param array $data
     * @param ?string $referenceId
     * @param string|null $sdkToken
     * @param bool $runOcr
     * @return array|mixed
     * @throws RequestException
     * @see https://idwall-maestro.readme.io/reference/create-profile-with-sdk-key
     */
    public function createWithSdkToken(
        array $data,
        string $referenceId = null,
        string $sdkToken = null,
        bool $runOcr = false
    ): mixed
    {
        if ($referenceId) {
            $data['ref'] = $referenceId;
        }

        if ($sdkToken) {
            $data['sdkToken'] = $sdkToken;
        }

        $query['runOCR'] = $runOcr ? 'true' : 'false';

        return $this->post('/profile/sdk', $data, $query);
    }

    /**
     * @param string $referenceId
     * @return mixed
     * @throws RequestException
     */
    public function find(string $referenceId): mixed
    {
        return $this->get("/profile/{$referenceId}");
    }


    /**
     * @param array $data
     * @param string $referenceId
     * @param string|null $sdkToken
     * @param bool $runOcr
     * @return mixed
     */
    public function updateWithSdkToken(
        array $data,
        string $referenceId,
        string $sdkToken = null,
        bool $runOcr = false
    ): mixed
    {
        if ($sdkToken) {
            $data['sdkToken'] = $sdkToken;
        }

        $query['runOCR'] = $runOcr ? 'true' : 'false';

        return $this->put('/profile/'. $referenceId .'/sdk', $data, $query);
    }
}