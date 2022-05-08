<?php

namespace Toshkq93\Logger\Exeptions;

use Exception;

class NotFoundDriverExeption extends Exception
{
    public function render()
    {
        abort(404);
    }
}
