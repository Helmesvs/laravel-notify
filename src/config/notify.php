<?php

return [
    //General Options 
    'options' => [
        'lib' => 'toastr', //toastr or pnotify
        'style' => 'custom', //default or custom (custum is recommended)
        //Files include//
        //Include case no exists in your page
        'include:Jquery' => true, //Include file jquery-***.min.js
        'include:Animate' => true  //Include file animate.cs
    ],
    //Toastr
    //Documentation: https://github.com/CodeSeven/toastr#other-options
    'ToastrOptions' => [
        "closeButton" => false, //Optionally enable a close button
        //"closeHtml" => '', //Optionally override the close button's HTML. <button><i class="icon-off"></i></button>
        "newestOnTop" => true,
        "progressBar" => false, //Visually indicate how long before a toast expires.
        "positionClass" => 'toast-top-right',
        "preventDuplicates" => true, //Duplicates are matched to the previous toast based on their message content.
        "showDuration" => '500',
        "hideDuration" => '900',
        "timeOut" => '4000', // How long the toast will display without user interaction
        "extendedTimeOut" => '1000', // How long the toast will display after a user hovers over it
        "showEasing" => 'linear',
        "hideEasing" => 'linear',
        "showMethod" => 'fadeIn',
        "hideMethod" => 'fadeOut'
    ],
    //
    //PNotify
    //Documentation: https://github.com/sciactive/pnotify
    'PNotifyOptions' => [
        //'title' => false, //The notice's title.
        //'text' => false, //The notice's text.
        //'type' => 'notice', //Type of the notice. "notice", "info", "success", or "error".
        'title_escape' => false, //Whether to escape the content of the title. (Not allow HTML.)
        'text_escape' => false, //Whether to escape the content of the text. (Not allow HTML.)
        'styling' => 'brighttheme', //Can be either "brighttheme", "jqueryui", "bootstrap2", "bootstrap3", "fontawesome", or a custom style object.
        'addclass' => '', //Additional classes to be added to the notice. (For custom styling.)
        'cornerclass' => null, //Class to be added to the notice for corner styling.
        'auto_display' => true, //Display the notice when it is created.
        'width' => '300px', //Width of the notice
        'min_height' => '16px', //Minimum height of the notice. It will expand to fit content.
        'icon' => true, //false for no icon, or a string for your own icon class.
        /*
         * The animation to use when displaying and hiding the notice.
         * "none", "show", "fade", and "slide" are built in to jQuery.
         * Others require jQuery UI. Use an object with effect_in and effect_out to use different effects.
         */
        'animation' => 'fade',
        'animate_speed' => 'slow', //Speed at animates in and out. "slow", "def" or "normal", "fast" or number of milliseconds.
        'position_animate_speed' => 500, //Specify a specific duration of position animation.
        'opacity' => 1, //Opacity of the notice.
        'shadow' => true, //Display a drop shadow.
        'hide' => true, //After a delay, remove the notice.
        'delay' => 4e3, //Delay in milliseconds before the notice is removed.
        'mouse_reset' => true, //Reset the hide timer if the mouse moves over the notice.
        'remove' => true, //Remove the notice's elements from the DOM after it is removed.
        'insert_brs' => true, //Change new lines to br tags.
        //Desktop Module
        'desktop' => [
            'desktop' => false, //Display the notification as a desktop notification.
            'fallback' => true, //If desktop notifications are not supported or allowed, fall back to a regular notice.
            'icon' => false, //The URL of the icon to display. If false, no icon will show. If null, a default icon will show.
        ],
        //Buttons Module
        'buttons' => [
            'closer' => true, //Provide a button for the user to manually close the notice.
            'closer_hover' => true, //Only show the closer button on hover.
            'sticker' => false, //Provide a button for the user to manually stick the notice.
            'sticker_hover' => true, //Only show the sticker button on hover.
            'show_on_nonblock' => false, //Show the buttons even when the nonblock module is in use.
            'labels' => [
                'close' => "Close",
                'stick' => "Stick",
                'unstick' => "Unstick"
            ] //Lets you change the displayed text, facilitating internationalization.
        ],
        //NonBlock Module
        'nonblock' => [
            'nonblock' => true //Create a non-blocking notice. It lets the user click elements underneath it.
        ],
        //Mobile Module
        'mobile' => [
            'swipe_dismiss' => true, //Let the user swipe the notice away.
            'styling' => true //Styles the notice to look good on mobile.
        ],
        //Animate Module (use animate.css)
        'animate' => [
            'animate' => true, //Use animate.css to animate the notice.
            'in_class' => 'fadeInRight', //The class to use to animate the notice in.
            'out_class' => 'fadeOutRight' //The class to use to animate the notice out.
        ],
    ]
];

