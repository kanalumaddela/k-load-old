<?php

if ($debug == 1) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}
ini_set('short_open_tag', 0);
if (empty($steamauth['apikey'])) {
    $login = 0;
    errorlog('[K-Load Error] - SteamAPI key not set, disabling steam auth logins');
}
if (empty($mysql['host'])) {
    $login = 0;
    errorlog('[K-Load Error] - MySQL host not set, disabling steam auth logins');
}
if (empty($color['background'])) {
    $color['background'] = '#121212';
}
if (empty($color['text'])) {
    $color['text'] = '#fff';
}
if (empty($color['primary'])) {
    $color['primary'] = '#fff';
}
if (empty($color['secondary'])) {
    $color['secondary'] = '#fff';
}
$demo = (isset($_GET['demo'])) ? 1 : 0;
$steam64 = (!empty($_GET['steamid'])) ? $_GET['steamid'] : $admin_id;
$banned = 0;
$mapname = 'no_map';

if (empty($mysql['host'])) {
    $mysql['host'] = 'localhost';
}
if (empty($mysql['port'])) {
    $mysql['port'] = '3306';
}
if (empty($mysql['user'])) {
    $login = 1;
}
if (empty($mysql['db'])) {
    $login = 1;
}

define('DB_HOST', $mysql['host'].':'.$mysql['port']);
define('DB_USER', $mysql['user']);
define('DB_PASS', $mysql['pass']);
define('DB_DATABASE', $mysql['db']);
define('DB_TABLE', $mysql['table']);
