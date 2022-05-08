<?php

namespace Toshkq93\Logger\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Toshkq93\Logger\Contracts\Services\iLoggerDriverService;

class Logger
{
    public function __construct(
        private iLoggerDriverService $service
    )
    {
        $this->service->boot();
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }

    /**
     * @param Request $request
     * @param JsonResponse $response
     * @return void
     */
    public function terminate(Request $request, $response): void
    {
        if (config('logger.enable')) {
            $this->service->create($request, $response);
        }
    }
}
