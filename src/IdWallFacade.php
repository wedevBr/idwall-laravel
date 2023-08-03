<?php

namespace WeDevBr\IdWall;

use Illuminate\Support\Facades\Facade;

/**
 * @see \WeDevBr\IdWall\IdWall
 */
class IdWallFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'idwall';
    }
}
