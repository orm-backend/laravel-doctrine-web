<?php
namespace ItAces\Web;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Container\Container;
use ItAces\Web\Components\MenuComponent;
use ItAces\Web\Menu\MenuFactory;
use ItAces\Web\Menu\MenuFactoryImplementation;
use ItAces\Web\Menu\MenuMiddleware;

class PackageServiceProvider extends ServiceProvider
{
    public function __construct($app) {
        parent::__construct($app);
    }
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../resources' => resource_path(),
            __DIR__.'/../../../app/Http/Controllers' => app_path('Http/Controllers'),
            __DIR__.'/../../../routes' => base_path('routes')
        ], 'itaces-web');
        
        Blade::component('menu', MenuComponent::class);
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MenuFactory::class, MenuFactoryImplementation::class);
        $this->app->alias(MenuFactory::class, 'menu');
        
        $this->callAfterResolving('router', function(Router $router, Container $app) {
            $router->aliasMiddleware('menu', MenuMiddleware::class);
        });
    }

}
