# avatar
Gmail-like default avatars using initials

## Contents
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

## Installation

### Via Composer in Terminal

``` bash
$ composer require adetoola/sms
```

### Via Composer in composer.json
Begin by installing `avatar` by editing your project's `composer.json` file. Just add

    'require": {
        "adetoola/avatar": "0.1.*"
    }

Then run `composer install` or `composer update`.

If you are using laravel, open `config/app.php` add in the `providers` array.

``` php
'providers' => [
    // ...
    Adetoola\Avatar\AvatarServiceProvider::class,
],
```

Then, find the `aliases` and add `Facade` to the array.

``` php
'aliases' => [
    // ...
    'Avatar' => Adetoola\Avatar\Facades\AvatarFacade::class,
],
```

## Configuration

After installing, publish the package configuration file into your application by running

``` php
php artisan vendor:publish
```

##Usage
Avatar is built to be easy to use.
```php
$avatar = new Adettola\Avatar\Avatar();
$image = $avatar->size(150)
                ->background('#fff')
                ->rounded()
                ->color('#eee')
                ->font('roboto.ttf')
                ->fontSize(0.667)
                ->generate()
                ->stream();

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email adetola.onasanya@gmail.com instead of using the issue tracker.

## Credits

- [Adetola Onasanya](https://github.com/Adetoola)

## License

SMS is an open-sourced package licensed under the [MIT license](http://opensource.org/licenses/MIT).
