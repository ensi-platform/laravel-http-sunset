<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/**
 * Middleware that checks if api method is not deprecated
 * @link https://datatracker.ietf.org/doc/html/rfc8594
 */
class SunsetMiddleware
{
    /** If API method is considered deprecated, we set a Sunset header with timestamp from config file */
    public function handle(Request $request, Closure $next)
    {
        /** @var Response|mixed $response */
        $response = $next($request);

        $patterns = config('sunset.paths', []);
        $uri      = Route::current()->uri();

        $sunsetDate = $this->checkIfDeprecated($patterns, $uri);

        if ($sunsetDate === null) {
            return $response;
        }

        return $response->header('Sunset', $sunsetDate);
    }

    /**
     * Iterate over deprecated paths and find if requested uri matches
     * @param string[] $patterns
     * @return null|string Found HTTP-date timestamp; null otherwise
     */
    private function checkIfDeprecated(array $patterns, string $uri): ?string
    {
        foreach ($patterns as $path => $sunsetDate) {
            $isRouteDeprecated = Str::is($path, $uri);

            if ($isRouteDeprecated) {
                return Carbon::parse($sunsetDate)->format(DateTimeInterface::RFC7231);
            }
        }

        return null;
    }
}
