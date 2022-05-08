<?php

namespace Toshkq93\Logger\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;
use Toshkq93\Logger\Contracts\Services\iLoggerDriverService;
use Toshkq93\Logger\Http\Requests\ShowLogRequest;

class LoggerController extends Controller
{
    public function __construct(
        private iLoggerDriverService $service
    )
    {
    }

    /**
     * @param ShowLogRequest $request
     * @return Application|Factory|View
     * @throws UnknownProperties
     */
    public function index(ShowLogRequest $request): Application|Factory|View
    {
        return view('logs::log.index', [
            'logs' => $this->service->show($request->getFilterDTO())
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function filters(): JsonResponse
    {
        return response()->json(
            $this->service->getDataByFilter()
        );
    }

    /**
     * @return RedirectResponse
     */
    public function delete(): RedirectResponse
    {
        $this->service->delete();
        return redirect()->route('logs');
    }
}
