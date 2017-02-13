# Microizer Blog

## Installation
Install using composer
`composer require shittyadvice/microblog`

Register the ServiceProvider & Alias
```php
//providers array
ShittyAdvice\MicroBlog\Providers\MicroBlogServiceProvider::class,
//aliases array
'Blog' => ShittyAdvice\MicroBlog\MicroBlog::class,
```

Migrate the database
`php artisan migrate`

Load the plugin settings
`php artisan plugin:reload`
