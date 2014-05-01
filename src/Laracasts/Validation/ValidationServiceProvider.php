<?php namespace Laracasts\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {

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
		$this->app->bind(
			'Laracasts\Validation\FactoryInterface',
			'Laracasts\Validation\LaravelValidator'
		);
	}

	public function boot()
	{
		$this->package('laracasts/validation');
	}

}