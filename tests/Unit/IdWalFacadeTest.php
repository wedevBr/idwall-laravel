<?php

use WeDevBr\IdWall\IdWallFacade;
use WeDevBr\IdWall\IdWall;

it('resolves the facade accessor correctly', function () {
    // Assuming you have the service provider registered that binds 'idwall' to the concrete class.
    $resolvedInstance = IdWallFacade::getFacadeRoot();
    expect($resolvedInstance)->toBeInstanceOf(IdWall::class);
});
