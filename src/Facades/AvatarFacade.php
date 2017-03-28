<?php

namespace Adetoola\Avatar\Facades;

use Illuminate\Support\Facades\Facade;

class AvatarFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'avatar';
    }
}
