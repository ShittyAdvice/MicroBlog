# Microizer Blog

## Installation

#### Step One
Install using composer
```bash
composer require shittyadvice/microblog
```

#### Step Two
Register the ServiceProvider
```php
'providers' => [
    ...
    ShittyAdvice\MicroBlog\Providers\MicroBlogServiceProvider::class,
];
```

#### Step Three
Migrate the database
```bash
php artisan db:migrate
```

#### Step Four
Reload Microizer plugins. This will generate all the required links etc.
```bash
php artisan plugin:reload
```
