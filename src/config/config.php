<?php

return [
    //Toastr
    'options' => [
        'lib' => 'toastr', //toastr or pnotify
    ],
    //Toastr
    'ToastrOptions' => [
        "closeButton" => true,
        "debug" => false,
        "newestOnTop" => true,
        "progressBar" => false,
        "positionClass" => 'toast-top-right',
        "preventDuplicates" => true,
        "onclick" => null,
        "showDuration" => '300',
        "hideDuration" => '1000',
        "timeOut" => '4000',
        "extendedTimeOut" => '1000',
        "showEasing" => 'swing',
        "hideEasing" => 'linear',
        "showMethod" => 'fadeIn',
        "hideMethod" => 'fadeOut'
    ],
    //PNotify
    'PNotifyOptions' => []
];

