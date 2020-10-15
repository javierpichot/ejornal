<?php
/**
 * Created by PhpStorm.
 * User: vdjkelly
 * Date: 13/11/18
 * Time: 09:32 AM
 */

namespace App\Http\Middleware;
use Closure;

class CheckPlanEmpresa
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}