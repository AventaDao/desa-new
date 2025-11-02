<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserBlacklist;

class CheckBlacklist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Auto deactivate expired blacklists
        UserBlacklist::deactivateExpired();

        if (Auth::check()) {
            $user = Auth::user();
            
            // Check if user is blacklisted
            if ($user->isBlacklisted()) {
                $blacklist = $user->getBlacklistInfo();
                
                // Logout user
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                // Store blacklist info in session
                session([
                    'blacklisted' => true,
                    'blacklist_reason' => $blacklist->reason,
                    'blacklist_expires_at' => $blacklist->expires_at->format('d F Y H:i'),
                    'blacklist_remaining' => $blacklist->remaining_time,
                ]);
                
                return redirect()->route('login');
            }
        }
        
        return $next($request);
    }
}