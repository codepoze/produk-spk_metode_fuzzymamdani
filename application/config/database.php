<?php
defined('BASEPATH') or exit('No direct script access allowed');

$active_group  = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'          => '',
    'hostname'     => 'localhost',
    'username'     => 'my_root',
    'password'     => 'my_pass',
    'database'     => 'skripsi_spk_fuzzy-mamdani',
    'dbdriver'     => 'mysqli',
    'port'         => '3306',
    'dbprefix'     => '',
    'pconnect'     => FALSE,
    'db_debug'     => (ENVIRONMENT !== 'production'),
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => FALSE,
    'compress'     => FALSE,
    'stricton'     => FALSE,
    'failover'     => array(),
    'save_queries' => TRUE
);

$db['production'] = array(
    'dsn'          => '',
    'hostname'     => 'sql300.infinityfree.com',
    'username'     => 'if0_34743758',
    'password'     => 'hLtg5NxKenwTtI',
    'database'     => 'if0_34743758_sipk',
    'dbdriver'     => 'mysqli',
    'port'         => '3306',
    'dbprefix'     => '',
    'pconnect'     => FALSE,
    'db_debug'     => 'production',
    'cache_on'     => FALSE,
    'cachedir'     => '',
    'char_set'     => 'utf8',
    'dbcollat'     => 'utf8_general_ci',
    'swap_pre'     => '',
    'encrypt'      => FALSE,
    'compress'     => FALSE,
    'stricton'     => FALSE,
    'failover'     => array(),
    'save_queries' => TRUE
);
