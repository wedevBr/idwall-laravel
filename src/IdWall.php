<?php

namespace WeDevBr\IdWall;

use WeDevBr\IdWall\Http\Clients\Business;
use WeDevBr\IdWall\Http\Clients\Matrix;
use WeDevBr\IdWall\Http\Clients\People;
use WeDevBr\IdWall\Http\Clients\Report;
use WeDevBr\IdWall\Http\Clients\User;

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
}
