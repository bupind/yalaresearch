<?php

function admin_url($uri = '', $protocol = NULL)
{
    $CI =& get_instance();
    return $CI->config->site_url($CI->config->item('admin_url').'/'.$uri, $protocol);
}

function admin_redirect($uri = '', $method = 'auto', $code = null)
{
    if ( ! preg_match('#^(\w+:)?//#i', $uri)) {
        $uri = admin_url($uri);
    }

    // IIS environment likely? Use 'refresh' for better compatibility
    if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== false) {
        $method = 'refresh';
    } elseif ($method !== 'refresh' && (empty($code) || ! is_numeric($code))) {
        if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1') {
            $code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
                ? 303   // reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
                : 307;
        } else {
            $code = 302;
        }
    }

    switch ($method) {
        case 'refresh':
            header('Refresh:0;url='.$uri);
            break;
        default:
            header('Location: '.$uri, TRUE, $code);
            break;
    }
    exit;
}