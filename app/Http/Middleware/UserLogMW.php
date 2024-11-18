<?php

namespace App\Http\Middleware;
use Str;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserLog;

class UserLogMW
{    /**
     * Handle an incoming request.
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next) : Response
    {
        //dump($request);
        $userAgent = $request->userAgent();
        if ($request->isJson()) {
            return $next($request);
        }
        if (is_null($userAgent)) {
            return $next($request);
        }
        // Записываем событие в базу данных
        UserLog::create([
            'subject' => session()->getId(),
            'user_id' => auth()->id(), 
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            // 'subject' => $request->format(),
            //'agent' => Str::substr($userAgent, 0, 255), 
            'agent' => $userAgent,
        ]);
        return $next($request);
    }
}
