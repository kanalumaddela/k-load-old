<?php

require_once 'config.php';
require_once 'includes/functions.php';
require_once 'includes/fixes.php';
require_once 'includes/mysql.php';
$dir = __DIR__;

if (!file_exists($dir.'/data/basepath.txt')) {
    touch($dir.'/data/basepath.txt');
}
if ($dir != file_get_contents('data/basepath.txt')) {
    $basepath = fopen($dir.'/data/basepath.txt', 'w');
    fwrite($basepath, $dir);
    fclose($basepath);
}
$currentpage = strtok($_SERVER['REQUEST_URI'], '?');
$actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$currentpage".'usercp/';
if (!empty($_GET['steamid'])) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conn->connect_error) {
        errorlog('[MySQL Error] - '.$conn->connect_error);
    }
    getUserTheme($_GET['steamid']);
    $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http')."://$_SERVER[HTTP_HOST]$currentpage".'usercp/';
}
if (!empty($_GET['mapname'])) {
    $mapname = $_GET['mapname'];
}
if (!empty($_GET['theme']) && file_exists($dir.'/themes/'.$_GET['theme'].'/index.php')) {
    $theme = $_GET['theme'];
}
$steamid = steam64_to_steamid($steam64);
if ($conn) {
    $conn->close();
}
include 'includes/steamauth/userInfo.php';
include 'themes/'.$theme.'/index.php';
