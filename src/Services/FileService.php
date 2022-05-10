<?php

namespace Toshkq93\Logger\Services;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Toshkq93\Logger\Contracts\Services\iLoggerDriverService;
use Toshkq93\Logger\DTO\Logger\DataDTO;
use Toshkq93\Logger\DTO\Logger\PaginatorDTO;
use Toshkq93\Logger\DTO\Logger\ShowDataDTO;
use Toshkq93\Logger\DTO\Logger\ShowDataDTOCollection;
use Toshkq93\Logger\Enums\FilterNamesEnum;
use Toshkq93\Logger\Filters\DataFilter;

class FileService extends LoggerService implements iLoggerDriverService
{
    const PERPAGE = 25;

    /**
     * @inheritDoc
     */
    public function create(Request $request, $response): void
    {
        $log = $this->createLogDTO($request, $response);
        $this->logging($log);
    }

    /**
     * @inheritDoc
     */
    public function show(DataFilter $filter): ShowDataDTOCollection
    {
        $result = [];

        if ($filter->getDirName()) {
            $files = $this->driver->allFiles($filter->getDirName());
            $result = array_merge($result, $this->getDataByFiles($files));
        } else {
            $directories = $this->driver->allDirectories();

            foreach ($directories as $directory) {
                $files = $this->driver->allFiles($directory);
                $result = array_merge($result, $this->getDataByFiles($files));
            }
        }

        return $this->toDTOPagonation($result, $filter);
    }

    /**
     * @inheritdoc
     */
    public function getDataByFilter(): array
    {
        $result = [];
        $filter = [];
        $directories = $this->driver->allDirectories();

        foreach ($directories as $directory) {
            $files = $this->driver->allFiles($directory);
            $result = array_merge($result, $this->getDataByFiles($files));
        }
        $userIds = collect($result)
            ->pluck('userId')
            ->unique()
            ->values()
            ->toArray();
        $controllers = collect($result)
            ->pluck('controller')
            ->unique()
            ->values()
            ->toArray();

        $filter[FilterNamesEnum::USER] = $userIds;
        $filter[FilterNamesEnum::CONTROLLER] = $controllers;
        $filter[FilterNamesEnum::DIRECTORY] = $directories;
        $filter[FilterNamesEnum::RESPONSE] = Response::$statusTexts;

        return $filter;
    }

    /**
     * @inheritdoc
     */
    public function delete(): void
    {
        $directories = $this->driver->allDirectories();
        foreach ($directories as $directory) {
            $files = $this->driver->allFiles($directory);
            foreach ($files as $file) {
                $filePath = $this->driver->path($file);
                File::delete($filePath);
            }
        }
    }

    /**
     * @param array $data
     * @param DataFilter $filter
     * @return ShowDataDTOCollection
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    private function toDTOPagonation(array $data, DataFilter $filter): ShowDataDTOCollection
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $collection = collect($data)->sortByDesc('date');
        $collection = $this->filter($collection, $filter);
        $list = [];

        $currentPageItems = $collection->slice(($currentPage * self::PERPAGE) - self::PERPAGE, self::PERPAGE)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, $collection->count(), self::PERPAGE);
        $paginatedItems->setPath(route('logs'));

        foreach ($paginatedItems->items() as $item) {
            if (!empty($item['models'])) {
                $item['models'] = $this->generateDataModel($item['models']);
            }
            if (!empty($item['queries'])) {
                $item['queries'] = $this->generateDataQuery(json_decode($item['queries'], 1));
            }

            if (!empty($item['messageError'])) {
                $item['messageError'] = $this->generateDataError(json_decode($item['messageError'], 1));
            }
            $list[] = (new ShowDataDTO($item));
        }

        return new ShowDataDTOCollection(
            items: $list,
            paginator: new PaginatorDTO(
                link: $paginatedItems->links(),
            )
        );
    }

    /**
     * @param array $files
     * @return array
     */
    private function getDataByFiles(array $files): array
    {
        $result = [];

        foreach ($files as $file) {
            $filePath = $this->driver->path($file);

            if (!(File::isDirectory($filePath))) {
                $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

                foreach ($lines as $line) {
                    $result[] = json_decode($line, 1);
                }
            }
        }

        return $result;
    }

    /**
     * @param Collection $collection
     * @param DataFilter $filter
     * @return Collection
     */
    private function filter(Collection $collection, DataFilter $filter): Collection
    {
        if ($filter->getController()) {
            $collection = $collection->filter(function ($item) use ($filter, $collection) {
                if (Str::contains($item['controller'], $filter->getController())) {
                    return $item;
                }
            });
        }
        if ($filter->getUserId()) {
            $collection = $collection->where('userId', $filter->getUserId());
        }
        if ($filter->getDateStart()){
            $collection = $collection->where('date',' >= ', $filter->getDateStart());
        }
        if ($filter->getDateEnd()){
            $collection = $collection->where('date',' <= ', $filter->getDateEnd());
        }
        if ($filter->getMethod()){
            $collection = $collection->where('method', $filter->getMethod());
        }
        if ($filter->getMethodStatus()){
            $collection = $collection->where('status', $filter->getMethodStatus());
        }

        return $collection;
    }

    /**
     * @return string
     */
    private function getDirPath(): string
    {
        return storage_path('logs\\' . env('APP_NAME', 'laravel')) . DIRECTORY_SEPARATOR . $this->folderName;
    }

    /**
     * @param DataDTO $log
     * @return void
     */
    private function logging(DataDTO $log): void
    {
        File::makeDirectory($this->getDirPath(), 0777, true, true);

        File::append(($this->getDirPath() . DIRECTORY_SEPARATOR . $log->getLogName() . '.log'), json_encode($log) . PHP_EOL);
    }
}
