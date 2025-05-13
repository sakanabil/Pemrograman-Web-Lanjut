<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        $user_role = $request->user()->getrole(); // ambil data level_kode
        if(in_array($user_role, $roles)) { // cek apakah ada level_kode didalam array roles
            return $next($request); // jika ada maka lanjutkan request
        }

        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}