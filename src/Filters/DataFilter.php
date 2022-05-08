<?php

namespace Toshkq93\Logger\Filters;

use App\DTO\Casters\Date\CarbonCaster;
use Carbon\Carbon;
use Spatie\DataTransferObject\Attributes\CastWith;
use Spatie\DataTransferObject\Attributes\MapFrom;
use Toshkq93\Logger\DTO\BaseDTO;

class DataFilter extends BaseDTO
{
    public null|string $method;
    #[MapFrom('method_status')]
    public null|int $methodStatus;
    #[CastWith(CarbonCaster::class), MapFrom('date_start')]
    public null|Carbon $dateStart;
    #[CastWith(CarbonCaster::class), MapFrom('date_end')]
    public null|Carbon $dateEnd;
    #[MapFrom('user_id')]
    public null|int $userId;
    public null|string $controller;
    public null|string $ip;
    #[MapFrom('dir_name')]
    public null|string $dirName;

    /**
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }

    /**
     * @return int|null
     */
    public function getMethodStatus(): ?int
    {
        return $this->methodStatus;
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
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
    public function getIp(): ?string
    {
        return $this->ip;
    }

    /**
     * @return string|null
     */
    public function getDirName(): ?string
    {
        return $this->dirName;
    }

    /**
     * @return Carbon|null
     */
    public function getDateStart(): ?Carbon
    {
        return $this->dateStart;
    }

    /**
     * @return Carbon|null
     */
    public function getDateEnd(): ?Carbon
    {
        return $this->dateEnd;
    }
}
