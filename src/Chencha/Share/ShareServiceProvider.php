<?php namespace Chencha\Share;

use Illuminate\Support\ServiceProvider;

class ShareServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        $configPath = __DIR__.'/../../config/social-share.php';
        $this->publishes([$configPath => config_path('social-share.php')]);
        $this->loadViewsFrom(__DIR__.'/../../views', 'social-share');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $configPath = __DIR__.'/../../config/social-share.php';
        $this->mergeConfigFrom($configPath, 'social-share');

		$this->app->singleton('share', function($app)
		{
			return new Share($app);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('share');
	}

}
