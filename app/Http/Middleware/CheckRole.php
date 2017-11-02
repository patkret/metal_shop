<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if ($request->user() === null) {

            return redirect(route('login'));
        }


        $modules = $request->user()->getModules();

        $controller = explode('@',$request->route()->getAction()['controller']);

        $exploded = explode('\\',$controller[0]);

        $controllerFinal = strtolower(str_replace('Controller', '', $exploded[count($exploded)-1]));

        foreach ($modules as $module) {

            if ($module->path === $controllerFinal) {

                return $next($request);
            }

        }
        return redirect()->back();

    }
}

//        $roles = isset($actions['roles']) ? $actions['roles'] : null;
//
//
//        if($request->user()->hasAnyRole($roles)){
//
//            return $next($request);
//        }

//        return redirect(route('login'));




