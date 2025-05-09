<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('login_url')) {
    function login_url($url = NULL)
    {
        $link = ($url) ? '/' . $url : '';
        return site_url('auth/login') . $link;
    }
}

if (! function_exists('register_url')) {
    function register_url($url = NULL)
    {
        $link = ($url) ? '/' . $url : '';
        return site_url('auth/register') . $link;
    }
}

// untuk logout url
if (! function_exists('logout_url')) {
    function logout_url($url = NULL)
    {
        $link = ($url) ? '/' . $url : '';
        return site_url('auth/logout') . $link;
    }
}

// untuk admin url
if (! function_exists('admin_url')) {
    function admin_url($url = NULL)
    {
        $link = ($url) ? '/' . $url : '';
        return site_url('admin/') . $link;
    }
}

if (! function_exists('upload_path')) {
    function upload_path($path = NULL)
    {
        $link = ($path) ? $path . '/' : '';
        return 'public/uploads/' . $link;
    }
}

if (! function_exists('upload_url')) {
    function upload_url($url = NULL)
    {
        $link = ($url) ? $url . '/' : '';
        return site_url(upload_path()) . $link;
    }
}

// untuk mengambil seluruh url
if (! function_exists('assets_url')) {
    function assets_url($url = NULL)
    {
        $link = ($url) ? $url . '/' : '';
        return site_url(assets_path()) . $link;
    }
}

// untuk mengambil assets path url
if (! function_exists('assets_path')) {
    function assets_path($path = NULL)
    {
        $link = ($path) ? $path . '/' : '';
        return 'public/assets/' . $link;
    }
}
