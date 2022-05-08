<?php

namespace Toshkq93\Logger\DTO\Logger;

use App\DTO\Casters\Date\CarbonCaster;
use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\CastWith;
use Toshkq93\Logger\DTO\BaseDTO;

class ShowDataDTO extends BaseDTO
{
    public ?string $ip;
    public ?int $userId;
    public ?float $duration;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $date;
    public ?string $url;
    public ?ModelDTOCollection $models;
    public ?string $methodController;
    public ?string $controller;
    public ?string $queries;
    public ?string $messageError;
    public ?string $method;
    public ?string $status;
    public ?string $logName;

    /**
     * @return string|null
     */
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @return float|null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @return Carbon|null
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return ModelDTOCollection|null
     */
    public function getModels(): ?ModelDTOCollection
    {
        return $this->models;
    }

    /**
     * @return string|null
     */
    public function getMethodController(): ?string
    {
        return $this->methodController;
    }

    /**
     * @return string|null
     */
    public function getController(): ?string
    {
        return $this->controller;
    }

    /**
     * @return string|null
     */
    public function getQueries(): ?string
    {
        return $this->queries;
    }

    /**
     * @return string|null
     */
    public function getMessageError(): ?string
    {
        return $this->messageError;
    }

    /**
     * @param string|null $messageError
     */
    public function setMessageError(?string $messageError): self
    {
        $this->messageError = $messageError;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @return string|null
     */
    public function getLogName(): ?string
    {
        return $this->logName;
    }

    /**
     * @param ModelDTOCollection|null $models
     * @return $this
     */
    public function setModels(?ModelDTOCollection $models): self
    {
        $this->models = $models;
        return $this;
    }

    /**
     * @param string|null $queries
     * @return $this
     */
    public function setQueries(?string $queries): self
    {
        $this->queries = $queries;
        return $this;
    }
}
