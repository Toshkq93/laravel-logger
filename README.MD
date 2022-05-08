# API Logger

##  Installation

Install the package via composer

```bash
composer require toshkq93/laravel-logger
```
## Usage

1.  Laravel 5.5 and higher uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider. If you use a lower version of Laravel you must register it in your
    _app.php_ file:

```bash
Toshkq93\Logger\Providers\LoggerServiceProvider::class
```

2. Publish the config file with:

```bash
php artisan vendor:publish --provider="Toshkq93\Logger\Providers\LoggerServiceProvider"
```

By default the logger will use *file* to log the data.

3. Add middleware named ***logger*** to the route or controller you want to log data

```php
Route::group([
        'middleware' => 'logger',
    ], function (){
    Route::post('/start', 'start');
});
```
Saving data will be stable along the way ***storage/logs/{NAME_YOUR_PROJECT}***. If you want to split a folder into several routes, you need to create a class with variable constants along the path. Example:

```php
class LoggerName
{
    const TELEPHONY = 'telephony';
    const USER = 'user';
    const CHAT = 'chat';
    const FILE = 'file';

}
```
And add in group route:

```php
Route::group([
        'middleware' => 'logger',
        'group' => LoggerNameEnum::TELEPHONY
    ],function (){
        Route::post('/start', 'start');
        Route::post('/finish', 'finish');
    });
```

And when you go along these paths of the route, then along the way ***storage/logs/{NAME_YOUR_PROJECT}/{LoggerNameEnum::TELEPHONY}***

If you get an error, then a file called error.log will be created, if everything is fine, then success.log

4. Dashboard can be accessible via yourdomain.com/logs

## Security

If you discover any security related issues, please email ***a.stanovoi170993@gmail.com*** instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
