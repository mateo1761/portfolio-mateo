<?php

namespace App\Http\Middleware;

use App\Actions\PruneExpiredPortfolioDataAction;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function Illuminate\Support\defer;

class RunOpportunisticMaintenance
{
    public function __construct(
        private readonly PruneExpiredPortfolioDataAction $pruneExpiredPortfolioData,
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((bool) config('maintenance.opportunistic_pruning')) {
            defer(fn () => $this->pruneExpiredPortfolioData->handle());
        }

        return $next($request);
    }
}
