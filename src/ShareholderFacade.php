<?php

namespace GetThingsDone\Shareholder;

use Illuminate\Support\Facades\Facade;

/**
 * @see \GetThingsDone\Shareholder\Shareholder
 */
class ShareholderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shareholder';
    }
}
