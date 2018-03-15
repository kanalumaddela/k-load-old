<?php
function errorlog($string) {
    global $dir, $error_log_file;
    $current_time = date('m/d/Y h:i:s', time() );
    if (!empty($dir)) {
        $file = $dir . "/" . $error_log_file;
    }
    if (file_exists( realpath('../data/basepath.txt') )) {
        $dir = file_get_contents( realpath('../data/basepath.txt') );
        $file = $dir . "/" . $error_log_file;
    }
    $file = $dir . "/" . $error_log_file;
    if (!file_exists($file)) { touch($file); }
    $handler = fopen($file, "a");
    fwrite($handler, $current_time . ' - ' . $string . "\n");
    fclose($handler);
}
function wipeLogs() {
    global $dir, $error_log_file;
    $current_time = date('m/d/Y h:i:s', time() );
    if (!empty($dir)) {
        $file = $dir . "/" . $error_log_file;
    }
    if (file_exists( realpath('../data/basepath.txt') )) {
        $dir = file_get_contents( realpath('../data/basepath.txt') );
        $file = $dir . "/" . $error_log_file;
    }
    $file = $dir . "/" . $error_log_file;
    if (!file_exists($file)) { touch($file); }
    $handler = fopen($file, "w");
    fclose($handler);
    echo '<h5>Logs Wiped</h5><script>setTimeout(function(){ window.location = "./?logs"; }, 1500);</script>';
}

function getYouTubePlaylistID($url) {
    $url = parse_url($url);
    parse_str($url['query'],$q);
    $playlist_id = $q['list'];
    
    return $playlist_id;
}
function getImgurID($url) {
    $imgur_id = '';
    if ( preg_match('~/\K\w+(?=[^/]*$)~m', $url, $match) ) {
        $imgur_id = $match[0];
    }
    return $imgur_id;
}
function getImgurIDwExt($url) {
    $imgur_id = '';
    if ( preg_match('#^.+/([^/]+)(\.[^/]+)?$#', $url, $match) ) {
        $imgur_id = $match[1];
    }
    return $imgur_id;
}
function steam64_to_steamid($steam64) {
    $authserver = bcsub( $steam64, '76561197960265728' ) & 1;
    $authid = ( bcsub( $steam64, '76561197960265728' ) - $authserver ) / 2;
    $steam32 = "STEAM_0:$authserver:$authid";
    return $steam32;
}

function loadingBar($width) {
    if (empty($width) || !isset($width)) {
        $width = 80;
    }
    echo '<div id="loadingbar_container" style="width:'.$width.'%">
        <div class="secondary-color transition" id="loadingbar"></div>
    </div>'."\n";
}
function loadingurl() {
    global $actual_link;
    echo $actual_link;
}
function mapImage() {
    $mapfile = 'nomap.png';
    if (!empty($_GET['mapname'])) {
        if (file_exists('assets/images/maps/'.$_GET['mapname'].'.png')) {
            $mapfile = $_GET['mapname'].'.png';
        }
    }
    echo '<img id="mapimage" class="z-depth-1" src="assets/images/maps/'.$mapfile.'">';
}
function messages() {
    echo '<p id="messages"></p>'."\n";
}
function overlay() {
    global $overlay;
    $types = [
        "",
        "one",
        "two",
        "three",
        "four",
        "five",
        "six"
    ];
    if ($overlay != 0) { echo '<div class="fixed-background overlay '.$types[$overlay].'"></div>'."\n"; }
}
function userAvatar($class) {
    global $steamprofile;
    if (!empty($class)) {
        echo '<img id="useravatar" class="'.$class.'" src="'.$steamprofile['avatarfull'].'"/>'."\n";
    } else {
        echo '<img id="useravatar" src="'.$steamprofile['avatarfull'].'"/>'."\n";
    }
}
?>