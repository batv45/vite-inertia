<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default PHPFlasher driver
    |--------------------------------------------------------------------------
    | This option controls the default driver that will be used by PHPFlasher.
    |
    | Supported drivers: "flasher", "toastr", "noty", "sweetalert", "pnotify"
    |
    | Only "flasher" is supported by default, but you can install other options using composer.
    |
    | "toastr"     : composer require php-flasher/flasher-toastr-laravel
    | "noty"       : composer require php-flasher/flasher-noty-laravel
    | "notyf"      : composer require php-flasher/flasher-notyf-laravel
    | "sweetalert" : composer require php-flasher/flasher-sweetalert-laravel
    | "pnotify"    : composer require php-flasher/flasher-pnotify-laravel
    */
    'default' => 'notyf',

    /*
   |--------------------------------------------------------------------------
   | Inject PHPFlasher in Response
   |--------------------------------------------------------------------------
   | PHPFlasher scripts are added automatically before </body>, by listening
   | to the Response after the App is done.
   */
    'auto_render' => false,

];
