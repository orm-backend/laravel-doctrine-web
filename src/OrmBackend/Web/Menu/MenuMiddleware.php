<?php
namespace OrmBackend\Web\Menu;

use Closure;
use OrmBackend\Web\Events\BeforMenu;

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