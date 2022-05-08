<?php

namespace Toshkq93\Logger\DTO\Logger;

use Illuminate\View\View;
use Toshkq93\Logger\DTO\BaseDTO;

class PaginatorDTO extends BaseDTO
{
    public View $link;

    /**
     * @return View
     */
    public function getLink(): View
    {
        return $this->link;
    }
}
