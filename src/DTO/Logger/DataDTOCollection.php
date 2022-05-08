<?php

namespace Toshkq93\Logger\DTO\Logger;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Toshkq93\Logger\DTO\BaseDTO;

class DataDTOCollection extends BaseDTO
{
    #[CastWith(ArrayCaster::class, DataDTO::class)]
    public array $items;

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
