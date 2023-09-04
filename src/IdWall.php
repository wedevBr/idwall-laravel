<?php

namespace WeDevBr\IdWall;

use WeDevBr\IdWall\Http\Clients\ApiV2\Business;
use WeDevBr\IdWall\Http\Clients\ApiV2\Matrix;
use WeDevBr\IdWall\Http\Clients\ApiV2\People;
use WeDevBr\IdWall\Http\Clients\ApiV2\Report;
use WeDevBr\IdWall\Http\Clients\ApiV2\User;
use WeDevBr\IdWall\Http\Clients\ApiV3\Profile;

class IdWall
{
    /**
     * @return Business
     */
    public function clientBusiness(): Business
    {
        return new Business();
    }

    /**
     * @return Matrix
     */
    public function clientMatrix(): Matrix
    {
        return new Matrix();
    }


    /**
     * @return People
     */
    public function clientPeople(): People
    {
        return new People();
    }

    /**
     * @return Report
     */
    public function clientReport(): Report
    {
        return new Report();
    }

    /**
     * @return User
     */
    public function clientUser(): User
    {
        return new User();
    }

    public function clientProfile(): Profile
    {
        return new Profile();
    }
}
