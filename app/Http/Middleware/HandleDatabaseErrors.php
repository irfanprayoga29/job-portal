<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class HandleDatabaseErrors
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (QueryException $e) {
            if (str_contains($e->getMessage(), 'could not find driver')) {
                Log::error('Database driver not found: ' . $e->getMessage());
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'Database connection unavailable',
                        'message' => 'Please check database configuration'
                    ], 503);
                }
                
                return response()->view('errors.database', [
                    'message' => 'Database connection is not available. Please check your database configuration.'
                ], 503);
            }
            
            throw $e;
        }
    }
}
