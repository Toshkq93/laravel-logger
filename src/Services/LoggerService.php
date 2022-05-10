<?php

namespace Toshkq93\Logger\Services;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Toshkq93\Logger\DTO\Logger\DataDTO;
use Toshkq93\Logger\DTO\Logger\ModelDTO;
use Toshkq93\Logger\DTO\Logger\ModelDTOCollection;
use Toshkq93\Logger\Enums\LoggerStatusesEnum;

class LoggerService
{
    protected $folderName = '';
    public static null|array $models = [];
    protected Filesystem $driver;

    public function __construct()
    {
        $this->driver = Storage::build([
            'driver' => 'local',
            'root' => storage_path('logs\\' . env('APP_NAME', 'laravel'))
        ]);
    }

    /**
     * @inheritDoc
     */
    public function boot(): void
    {
        Event::listen('eloquent.*', function ($event, $models) {
            if (Str::contains($event, 'eloquent.retrieved')) {
                foreach (array_filter($models) as $model) {
                    $class = $this->getClassName(get_class($model));
                    static::$models[$class] = (static::$models[$class] ?? 0) + 1;
                }
            }
        });
    }

    /**
     * @param Request $request
     * @param $response
     * @return DataDTO
     */
    protected function createLogDTO(Request $request, $response): DataDTO
    {
        $this->folderName = $request->route()->getAction('group');
        $log = $this->generateLogData($request);

        if ($response->isClientError() or $response->isServerError()) {
            $log->setMessageError($response->getOriginalContent()['errors']);
            $log->setLogName(LoggerStatusesEnum::ERROR);
        } else {
            $log->setLogName(LoggerStatusesEnum::SUCCESS);
        }
        $log->setStatus($response->getStatusCode());

        return $log;
    }

    /**
     * @param string|null $data
     * @return ModelDTOCollection|null
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    protected function generateDataModel(?string $data): ModelDTOCollection|null
    {
        if ($data === "null" or $data == null) {
            return null;
        }

        $data = json_decode($data, 1);
        $list = [];

        foreach ($data as $key => $value) {
            $list[] = (new ModelDTO())
                ->setModelName($this->getClassName($key))
                ->setCount($value);
        }

        return new ModelDTOCollection(
            items: $list
        );
    }

    /**
     * @param array|null $data
     * @return string|null
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    protected function generateDataQuery(?array $data, $tab = ''): string|null
    {
        if ($data === "null" or $data == null) {
            return null;
        }

        $result = '';

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $result .= "{$tab}[$key] => <br>";
                $result .= $this->generateDataQuery($value, $tab . str_repeat(' &nbsp;', 4));
            } else {
                $result .= "{$tab}[$key] => <b>$value</b><br>";
            }
        }

        return $result;
    }

    /**
     * @param array|null $data
     * @return string|null
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    protected function generateDataError(?array $data, $tab = ''): string|null
    {
        if ($data === "null" or $data == null) {
            return null;
        }

        $result = '';

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $result .= "{$tab}[$key] => <br>";
                $result .= $this->generateDataError($value, $tab . str_repeat(' &nbsp;', 4));
            } else {
                $result .= "{$tab}[$key] => <b>$value</b><br>";
            }
        }

        return $result;
    }

    /**
     * @param Request $request
     * @return DataDTO
     */
    private function generateLogData(Request $request): DataDTO
    {
        $loggerDTO = new DataDTO();
        $loggerDTO->setUserId(Auth::id());
        $loggerDTO->setDate(Carbon::now());
        $loggerDTO->setIp($request->ip());
        $loggerDTO->setUrl($request->getUri());
        $loggerDTO->setMethodController($request->route()->getActionMethod());
        $loggerDTO->setController($request->route()->getControllerClass());
        $loggerDTO->setMethod($request->getMethod());
        $loggerDTO->setDuration(round(microtime(true) - LARAVEL_START, 3));
        $loggerDTO->setQueries($request->all());
        $loggerDTO->setModels(static::$models ?? null);

        return $loggerDTO;
    }

    /**
     * @param string $name
     * @return string
     */
    private function getClassName(string $name): string
    {
        $namespace = trim(implode('\\', array_slice(explode('\\', $name), 0, -1)), '\\');

        return str_replace($namespace . '\\', '', $name);
    }
}
