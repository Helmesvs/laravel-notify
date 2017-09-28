toastr
======

Easy [toastr.js](https://github.com/CodeSeven/toastr) notifications for Laravel 5, a ported version of Laravel 4 Toastr by [kamaln7](https://github.com/kamaln7/toastr)

Installation
------------

1. Either run `composer require oriceon/toastr-5-laravel` or add `"oriceon/toastr-5-laravel": "dev-master"` to the `require` key in `composer.json` and run `composer install`
2. Add `'Kamaln7\Toastr\ToastrServiceProvider',` to the `providers` key in `config/app.php`
3. Add `'Toastr'          => 'Kamaln7\Toastr\Facades\Toastr',` to the `aliases` key in `config/app.php`

Usage
-----

Include jQuery and [toastr.js](https://github.com/CodeSeven/toastr) in your master view template, and the output of    `Toastr::render()` afterwards:

``` html
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}
```

Call one of these methods in your controllers to insert a toast:
  - `Toastr::warning($message, $title = null, $options = [])` - add a warning toast
  - `Toastr::error($message, $title = null, $options = [])` - add an error toast
  - `Toastr::info($message, $title = null, $options = [])` - add an info toast
  - `Toastr::success($message, $title = null, $options = [])` - add a success toast
  - `Toastr::add($type: warning|error|info|success, $message, $title = null, $options = [])` - add a toast
  - **`Toastr::clear()` - clear all current toasts**

### Setting custom Toastr options

You can set custom options for Toastr. Run:

``` php
php artisan vendor:publish
```

to publish the config file for Toastr. Then edit `config/toastr.php` and set the `options` array to whatever you want to pass to Toastr. These options are set as the default options and can be overridden by passing an array of options to any of the methods in the **Usage** section.

For a list of available options, see [toastr.js' documentation](https://github.com/CodeSeven/toastr).
