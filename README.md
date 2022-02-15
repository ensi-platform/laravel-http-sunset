# laravel-http-sunset

Applies a sunset header to your deprecated http-paths. PHP 7.3+ required

## Installation
1. Copy and configure default config file:
```
cp config/sunset.php ../../../config/sunset.php`
```
2. Register a global middleware in `app/Http/Kernel.php` so every request goes through it: :
```
protected $middleware = [
    SunsetMiddleware::class,
    
    // other currently enabled middleware...        
];
```