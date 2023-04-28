<?php

namespace Mi\MiImageUtility\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mi\MiImageUtility\MiImageUtility
 */
class MiImageUtility extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mi\MiImageUtility\MiImageUtility::class;
    }
}
