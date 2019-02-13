<?php

header('Content-Type: application/json');
include '../config.php';
$debug = 0;
include 'functions.php';
include 'fixes.php';

$json_output = null;
if (!empty($_GET['steamid'])) {
    include 'mysql.php';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conn->connect_error) {
        errorlog('[MySQL Error] - Failed to connect: '.$conn->connect_error);
        $json_output->player = 1;
    }
    getUser($_GET['steamid']);
    $steamid = steam64_to_steamid($_GET['steamid']);
    $json_output->player->steam64 = $_GET['steamid'];
    $json_output->player->steamid = $steamid;
    $json_output->player->background_type = $user_bg_type;
    $json_output->player->volume = $user_volume;
    $json_output->player->music_type = $user_music_type;
    $json_output->player->youtube_playlist = $user_ytplaylist;
}
$json_output->gamemode_specific = $gamemode_specific;
$json_output->volume = $volume;
$json_output->message_random = $message['random'];
$json_output->message_duration = $message['duration'] * 1000;
$json_output->background_type = $background['type'];
if (!empty($background['video'])) {
    $json_output->background_video = $background['video'];
}
if (!empty($background['yt'])) {
    $json_output->background_yt = $background['yt'];
}
$json_output->background_random = $background['random'];
$json_output->background_duration = $background['duration'] * 1000;
if (!empty($youtube['playlist'])) {
    $json_output->youtube_playlist = $youtube['playlist'];
}

foreach ($rules as $key => $value) {
    $json_output->rules->$key = $value;
}
foreach ($message['list'] as $key => $value) {
    $json_output->messages->$key = $value;
}
foreach ($background['slideshow'] as $key => $value) {
    $json_output->backgrounds->$key = $value;
}
echo json_encode($json_output, JSON_PRETTY_PRINT);
