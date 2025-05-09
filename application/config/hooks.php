<?php
defined('BASEPATH') or exit('No direct script access allowed');

// $hook['post_controller_constructor'][] = array(
//     'function' => 'redirect_ssl',
//     'filename' => 'ssl.php',
//     'filepath' => 'hooks'
// );

$hook['display_override'][] = array(
    'class' => '',
    'function' => 'CI_Minifier_Hook_Loader',
    'filename' => '',
    'filepath' => ''
);