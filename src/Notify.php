<?php

namespace Helmesvs\Notify;

use Illuminate\Config\Repository;

class Notify {

    /**
     * Added notifications
     *
     * @var array
     */
    protected $notifications = [];

    /**
     * Added notifications
     *
     * @var array
     */
    protected $options = [];

    /**
     * Illuminate Session
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /**
     * Library config
     *
     * @var Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Constructor
     *
     * @param \Illuminate\Session\SessionManager $session
     * @param Repository|Illuminate\Config\Repository $config
     *
     * @internal param \Illuminate\Session\SessionManager $session
     */
    public function __construct(\Illuminate\Session\SessionManager $session, Repository $config) {
        $this->session = $session;
        $this->config = $config;
    }

    /**
     * Render the notifications' script tag
     *
     * @return string
     * @internal param bool $flashed Whether to get the
     *
     */
    public function render() {
        $notifications = $this->session->get('laravel::notifications');
        if (!$notifications)
            $notifications = [];

        $this->options = $this->config->get('notify.options');

        $output = $this->scripts();

        $output .= '<script type="text/javascript">';
        $lastConfig = [];
        foreach ($notifications as $notification) {

            $config = ($this->options['lib'] === 'toastr' ? $this->config->get('notify.ToastrOptions') : $this->config->get('notify.PNotifyOptions'));

            if (count($notification['options']) > 0) {
                // Merge user supplied options with default options
                $config = array_merge($config, $notification['options']);
            }

            // Config persists between toasts
            if ($config != $lastConfig) {
                $output .= ($this->options['lib'] === 'toastr' ? 'toastr.options = ' . $this->json_encode_advanced($config, false, true, true) . ';' : '');
                $lastConfig = $config;
            }

            if ($this->options['lib'] === 'toastr'):
                //Toastr output
                $output .= 'toastr.' . $notification['type'] . "('" . $notification['message'] . "'" . (isset($notification['title']) ? ", '" . str_replace("'", "\\'", htmlentities($notification['title'])) . "'" : null) . ');';
            else:
                //PNotify output
                $output .= "
                $(function () {
                    new PNotify({
                        title: '" . (isset($notification['title']) ? str_replace("'", "\\'", htmlentities($notification['title'])) : null) . "',
                        text: '" . $notification['message'] . "',
                        type: '" . $notification['type'] . "',
                        " . substr($this->json_encode_advanced($config, false, true, true), 1, -1) . "
                    });
            });";
            endif;
        }
        $output .= '</script>';

        return $output;
    }

    /**
     * Script string mount
     *
     * @return string Return required scrips 
     */
    public function scripts() {

        $scripts = '<link href="'. asset('vendor/Notify/themify-icons.css') .'" rel="stylesheet" type="text/css">';

        if ($this->options['include:Jquery']):
            $scripts .= '<script type="text/javascript" src="'. asset('vendor/Notify/jquery/jquery-3.2.1.min.js') .'"></script>;';
        endif;

        if ($this->options['lib'] === 'toastr'):
            $scripts .= '<link href="'. asset('vendor/Notify/toastr/toastr.min.css') .'" rel="stylesheet" type="text/css">
                         <script type="text/javascript" src="'. asset('vendor/Notify/toastr/toastr.min.js') .'"></script>';

        elseif ($this->options['lib'] === 'pnotify'):

            if ($this->options['include:Animate']):
                $scripts .= '<link href="'. asset('vendor/Notify/animate.css') .'" rel="stylesheet" type="text/css">';
            endif;

            $scripts .= '<link href="'. asset('vendor/Notify/pnotify/pnotify.custom.min.css') .'" rel="stylesheet" type="text/css">
                         <script type="text/javascript" src="'. asset('vendor/Notify/pnotify/pnotify.custom.min.js') .'"></script>';
            if ($this->config['desktop']['desktop'] === true):
                $scripts .= 'PNotify.desktop.permission();';
            endif;

        endif;

        if ($this->options['style'] === 'custom'):
            $scripts .= '<link href="'. asset('vendor/Notify/style.css') .'" rel="stylesheet" type="text/css">';
        endif;

        return $scripts;
    }

    /**
     * Add a notification
     *
     * @param string $type Could be error, info, success, or warning.
     * @param string $message The notification's message
     * @param string $title The notification's title
     *
     * @return bool Returns whether the notification was successfully added or 
     * not.
     */
    public function add($type, $message, $title = null, $options = []) {
        $allowedTypes = ['error', 'info', 'success', 'warning'];
        if (!in_array($type, $allowedTypes))
            return false;

        $this->notifications[] = [
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'options' => $options
        ];

        $this->session->flash('laravel::notifications', $this->notifications);
    }

    /**
     * Shortcut for adding an info notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function info($message, $title = null, $options = []) {
        $this->add('info', $message, $title, $options);
    }

    /**
     * Shortcut for adding an error notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function error($message, $title = null, $options = []) {
        $this->add('error', $message, $title, $options);
    }

    /**
     * Shortcut for adding a warning notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function warning($message, $title = null, $options = []) {
        $this->add('warning', $message, $title, $options);
    }

    /**
     * Shortcut for adding a success notification
     *
     * @param string $message The notification's message
     * @param string $title The notification's title
     */
    public function success($message, $title = null, $options = []) {
        $this->add('success', $message, $title, $options);
    }

    /**
     * Clear all notifications
     */
    public function clear() {
        $this->notifications = [];
    }

    /**
     * Convert array in json
     * @return Json Options for Pnotify 
     * not.
     */
    public function json_encode_advanced(array $arr, $sequential_keys = false, $quotes = false, $beautiful_json = false) {

        $output = $this->isAssoc($arr) ? "{" : "[";
        $count = 0;

        foreach ($arr as $key => $value) {

            if ($this->isAssoc($arr) || (!$this->isAssoc($arr) && $sequential_keys == true )) {
                $output .= ($quotes ? '"' : '') . $key . ($quotes ? '"' : '') . ' : ';
            }

            if (is_array($value)) {
                $output .= $this->json_encode_advanced($value, $sequential_keys, $quotes, $beautiful_json);
            } else if (is_bool($value)) {
                $output .= ($value ? 'true' : 'false');
            } else if (is_numeric($value)) {
                $output .= $value;
            } else {
                $output .= ($quotes || $beautiful_json ? '"' : '') . $value . ($quotes || $beautiful_json ? '"' : '');
            }

            if (++$count < count($arr)) {
                $output .= ', ';
            }
        }

        $output .= $this->isAssoc($arr) ? "}" : "]";

        return $output;
    }

    /*
     * Check if array is associative
     */

    public function isAssoc(array $arr) {
        if (array() === $arr)
            return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}
