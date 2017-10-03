<?php namespace Helmesvs\Notify;

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider {

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
		$this->publishes([
			__DIR__ . '/config/notify.php' => config_path('notify.php'),
			__DIR__ . '/assets/fonts/themify.woff@-fvbane' => public_path('vendor/Notify/fonts/themify.woff@-fvbane'),
			__DIR__ . '/assets/jquery/jquery-3.2.1.min.js' => public_path('vendor/Notify/jquery/jquery-3.2.1.min.js'),
			__DIR__ . '/assets/pnotify/pnotify.custom.min.css' => public_path('vendor/Notify/pnotify/pnotify.custom.min.css'),
			__DIR__ . '/assets/pnotify/pnotify.custom.min.js' => public_path('vendor/Notify/pnotify/pnotify.custom.min.js'),
			__DIR__ . '/assets/toastr/toastr.min.css' => public_path('vendor/Notify/toastr/toastr.min.css'),
			__DIR__ . '/assets/toastr/toastr.min.js' => public_path('vendor/Notify/toastr/toastr.min.js'),
			__DIR__ . '/assets/animate.css' => public_path('vendor/Notify/animate.css'),
			__DIR__ . '/assets/style.css' => public_path('vendor/Notify/style.css'),
			__DIR__ . '/assets/themify-icons.css' => public_path('vendor/Notify/themify-icons.css'),
		], 'notify');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('notify', function ($app) {
		    return new Notify($app['session'], $app['config']);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['notify'];
	}

}

