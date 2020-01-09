<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Models\Permission;

class AutoCheckPermission
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
      $routeName = $request->route()->getName(); //user.create
      //routes is the name of the column add in permissions table
      $permission = Permission::whereRaw("FIND_IN_SET ('$routeName', routes)")->first();
      if($permission)
      {
        if(!auth()->user()->can($permission->name))
        {
          abort('401');
        }
      }
        return $next($request);
    }
}
