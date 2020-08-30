<?php
namespace VVK\Web\Menu;

use Closure;
use VVK\Web\Events\BeforMenu;

class MenuMiddleware
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
        event(new BeforMenu());
        
        return $next($request);
    }
    
}