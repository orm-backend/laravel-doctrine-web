<?php
namespace ItAces\Web;

use Illuminate\Support\ServiceProvider;

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
    }
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
