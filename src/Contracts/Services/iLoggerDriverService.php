<?php

namespace Toshkq93\Logger\Contracts\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Toshkq93\Logger\DTO\Logger\ShowDataDTOCollection;
use Toshkq93\Logger\Filters\DataFilter;

interface iLoggerDriverService
{
    /**
     * @param Request $request
     * @param $response
     */
    public function create(Request $request, $response): void;

    /**
     * @param DataFilter $filter
     * @return ShowDataDTOCollection
     */
    public function show(DataFilter $filter): ShowDataDTOCollection;

    /**
     * @return array
     */
    public function getDataByFilter(): array;

    /**
     * @return void
     */
    public function delete(): void;
}
