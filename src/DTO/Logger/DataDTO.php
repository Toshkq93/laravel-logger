<?php

namespace Toshkq93\Logger\DTO\Logger;

use App\DTO\Casters\Date\CarbonCaster;
use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\CastWith;
use Toshkq93\Logger\DTO\BaseDTO;

class DataDTO extends BaseDTO
{
    public ?string $ip;
    public ?int $userId;
    public ?float $duration;
    #[CastWith(CarbonCaster::class)]
    public ?Carbon $date;
    public ?string $url;
    public ?string $models;
    public ?string $methodController;
    public ?string $controller;
    public ?string $queries;
    public ?array $messageError;
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
     * @param string|null $ip
     * @return $this
     */
    public function setIp(?string $ip): self
    {
        $this->ip = $ip;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return $this
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getDuration(): ?float
    {
        return $this->duration;
    }

    /**
     * @param float|null $duration
     * @return $this
     */
    public function setDuration(?float $duration): self
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return Carbon|null
     */
    public function getDate(): ?Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon|null $date
     * @return $this
     */
    public function setDate(?Carbon $date): self
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(?string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getModels(): ?array
    {
        return (array)json_decode($this->models);
    }

    /**
     * @param array|null $models
     * @return $this
     */
    public function setModels(?array $models): self
    {
        $this->models = json_encode($models);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMethodController(): ?string
    {
        return $this->methodController;
    }

    /**
     * @param string|null $methodController
     * @return $this
     */
    public function setMethodController(?string $methodController): self
    {
        $this->methodController = $methodController;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getController(): ?string
    {
        return $this->controller;
    }

    /**
     * @param string|null $controller
     * @return $this
     */
    public function setController(?string $controller): self
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getQueries(): ?array
    {
        return (array)json_decode($this->queries);
    }

    /**
     * @param array|null $queries
     * @return $this
     */
    public function setQueries(?array $queries): self
    {
        $this->queries = json_encode($queries);
        return $this;
    }

    /**
     * @return array|null
     */
    public function getMessageError(): ?array
    {
        return $this->messageError;
    }

    /**
     * @param array|null $messageError
     * @return $this
     */
    public function setMessageError(?array $messageError): self
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
     * @param string|null $method
     * @return $this
     */
    public function setMethod(?string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     * @return $this
     */
    public function setStatus(?string $status): self
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogName(): ?string
    {
        return $this->logName;
    }

    /**
     * @param string|null $logName
     */
    public function setLogName(?string $logName): self
    {
        $this->logName = $logName;
        return $this;
    }
}
