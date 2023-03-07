<?php

namespace Modules\HR\Facades;

class Holiday extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Modules\HR\Classes\Holiday::class;
    }
}
