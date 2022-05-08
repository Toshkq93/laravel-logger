<?php

namespace Toshkq93\Logger\DTO\Logger;

use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Toshkq93\Logger\DTO\BaseDTO;

class ShowDataDTOCollection extends BaseDTO
{
    #[CastWith(ArrayCaster::class, itemType: ShowDataDTO::class)]
    public array $items;
    public null|PaginatorDTO $paginator;

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return PaginatorDTO|null
     */
    public function getPaginator(): ?PaginatorDTO
    {
        return $this->paginator;
    }
}
