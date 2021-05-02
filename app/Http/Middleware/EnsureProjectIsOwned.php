<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureProjectIsOwned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $projectId = $request->route('project')->id;
        $projects = Auth::user()->projects;
        if ($projects->contains('id', $projectId)) {
            return $next($request);
        }
        return redirect("/");
    }
}