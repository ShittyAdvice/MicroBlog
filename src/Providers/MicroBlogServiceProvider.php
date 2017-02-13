<?php

namespace ShittyAdvice\MicroBlog\Providers;

use Illuminate\Support\ServiceProvider;

class MicroBlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services. We know all is instantiated!
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'blog');

        $this->publishes([
            __DIR__.'/../resources/views' => public_path('themes/default/views/blog'),
        ], 'views');
    }

	public function register()
	{
		$this->app['router']->group(['namespace' => 'ShittyAdvice\MicroBlog\Controllers'], function () {
            require __DIR__.'/../routes/web.php';
        });
	}
}
