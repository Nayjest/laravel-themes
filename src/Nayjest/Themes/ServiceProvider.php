<?php namespace Nayjest\Themes;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App;
use Config;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->package('nayjest/themes');
        # @todo check that illuminate/views loaded BEFORE
        $this->replaceFinder();
        $manager = Manager::instance();
        if ($manager->isEnabled()) {
            App::before(function ($request) use ($manager) {
                $manager->applyAll();
            });
        }
    }

    protected function replaceFinder()
    {
        $this->app->bindShared('view.finder', function ($app) {
            $paths = $app['config']['view.paths'];
            return new FileViewFinder($app['files'], $paths);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}