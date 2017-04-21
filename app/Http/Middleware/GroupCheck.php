<?php

namespace App\Http\Middleware;

use Closure;

class GroupCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

      $group = $request->groupname;

      if(strtolower($group) == 'miscellaneous'){
        return redirect()->to('/');
      }
        return $next($request);
    }
}
