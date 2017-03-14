<?php

namespace Microizer\Plugins\Microblog\Providers;

use Menu;
use Caffeinated\Menus\Builder;
use Caffeinated\Modules\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../Resources/Lang', 'microblog');
        $this->loadViewsFrom(__DIR__.'/../Resources/Views', 'microblog');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations', 'microblog');
        $this->setupMenu();
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function setupMenu()
    {
        $blog = Menu::get('backend')->add('Blog', '#')->icon('comments')->active('backend/blog/*');
        $blog->add('Posts', ['route' => 'backend.blog.posts.index'])->active('backend/blog/posts/*');

        Menu::get('main')->add('Blog', ['route' => 'blog.index'])->active('blog/*');
    }
}
