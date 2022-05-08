<?php

namespace Toshkq93\Logger\DTO\Logger;

use Toshkq93\Logger\DTO\BaseDTO;

class ModelDTO extends BaseDTO
{
    public ?string $modelName;
    public ?int $count;

    /**
     * @return null|string
     */
    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    /**
     * @param null|string $modelName
     */
    public function setModelName(?string $modelName): self
    {
        $this->modelName = $modelName;
        return $this;
    }

    /**
     * @return null|int
     */
    public function getCount(): ?int
    {
        return $this->count;
    }

    /**
     * @param null|int $count
     */
    public function setCount(?int $count): self
    {
        $this->count = $count;
        return $this;
    }
}
