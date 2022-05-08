<?php

namespace Toshkq93\Logger\Facades;

use Toshkq93\Logger\Services\FileService;
use Illuminate\Support\Facades\Facade;

class LoggerServiceFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FileService::class;
    }
}
