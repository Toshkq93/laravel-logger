<?php

namespace Toshkq93\Logger\DTO\Logger;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Toshkq93\Logger\DTO\BaseDTO;

class ModelDTOCollection extends BaseDTO
{
    #[CastWith(ArrayCaster::class, ModelDTO::class)]
    public array $items;

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
