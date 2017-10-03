Laravel Notify
======

Elegant notifications to laravel with [Toastr](https://github.com/CodeSeven/toastr) or [PNotify](https://github.com/sciactive/pnotify)

Installation
------------

1. Either run `composer require helmesvs/laravel-notify` or add `"helmesvs/laravel-notify"` to the `require` key in `composer.json` and run `composer install`.
2. Add `Helmesvs\Notify\NotifyServiceProvider::class,` to the `providers` key in `config/app.php`.
3. Add `'Notify' => Helmesvs\Notify\Facades\Notify::class,` to the `aliases` key in `config/app.php`.
4. Run `php artisan vendor:publish --provider="Helmesvs\Notify\NotifyServiceProvider" --tag="notify"` to publish the config file.
5. Include the output `{!! Notify::render() !!}` in your master view template.
6. *Optional*: Modify the configuration file located in config/notify.php.

Usage
-----

Call one of these methods in your controllers to insert a notification:
  - `Notify::warning($message, $title = null, $options = [])` - add a warning notification
  - `Notify::error($message, $title = null, $options = [])` - add an error notification
  - `Notify::info($message, $title = null, $options = [])` - add an info notification
  - `Notify::success($message, $title = null, $options = [])` - add a success notification
  - `Notify::add($type: warning|error|info|success, $message, $title = null, $options = [])` - add a notification
  - **`Notify::clear()` - clear all current notification**

Configuration
-------------

Open `config/notify.php` to adjust package configuration. If this file doesn't exist, run `php artisan vendor:publish --provider="Helmesvs\Notify\NotifyServiceProvider" --tag="notify"` to create the default configuration file.


### General Options 
``` php
'options' => [
        'lib' => 'toastr',
        'style' => 'custom'
]
```

Set `'lib'` as `toastr` to use [toastr.js](https://github.com/CodeSeven/toastr) or `pnotify` to use [pnotify.js](https://github.com/sciactive/pnotify).

Set `'style'` to `'custom'` to use custom settings, or as `'default'` to default library settings.

The style of notifications can be customized in `public/vendor/Notify/style.css`.

### Options Toastr
``` php
'ToastrOptions' => [
        "closeButton" => false,
        "closeHtml" => '',
        "newestOnTop" => true,
        "progressBar" => false,
        ...
]
```

### Options PNotify
``` php
'PNotifyOptions' => [
        'title_escape' => false,
        'text_escape' => false,
        'styling' => 'brighttheme',
        'addclass' => '', 
        ...
]
```

For a list of available options, see [toastr.js' documentation](https://github.com/CodeSeven/toastr) and [pnotify.js' documentation](https://github.com/sciactive/pnotify).
