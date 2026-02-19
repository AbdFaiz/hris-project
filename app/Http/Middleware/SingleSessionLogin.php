<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;
use Symfony\Component\HttpFoundation\Response;

class SingleSessionLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $activeSessions = DB::table('sessions')
                ->where('user_id', Auth::id())
                ->where('id', '!=', session()->getId())
                ->exists();
            
            if ($activeSessions) {
                Auth::logout();
                session()->invalidate();
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Akun sedang digunakan di perangkat lain'
                    ], 401);
                }
                
                return redirect()->route('filament.hris.auth.login')
                    ->with('filament.notifications', [
                        Notification::make()
                            ->danger()
                            ->title('Akses Ditolak')
                            ->body('Akun ini sedang digunakan di perangkat lain. Silakan logout dari perangkat tersebut terlebih dahulu.')
                            ->toArray()
                    ]);
            }
        }
        
        return $next($request);
    }
}