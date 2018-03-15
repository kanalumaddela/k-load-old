<?php
header('Content-Type: application/json');
include '../config.php';
$debug = 0;
include 'functions.php';
include 'fixes.php';

$staff_data = [];
if (!empty($staff)) {
    $cnt = 0;
    foreach ($staff as $staff_member) {
        if (!empty($steamauth['apikey'])) {
            $staff_data_temp = json_decode(file_get_contents("http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$steamauth['apikey']."&steamids=".$staff_member['steamid']), true);
            $player = [
                "steamid"=>$staff_data_temp['response']['players'][0]['steamid'],
                "avatar"=>$staff_data_temp['response']['players'][0]['avatarfull'],
                "name"=>$staff_data_temp['response']['players'][0]['personaname']
            ];
            array_push($staff_data, $player);
        }
        $staff_data[$cnt]['steamid'] = $staff_member['steamid'];
        $staff_data[$cnt]['rank'] = $staff_member['rank'];
        $cnt++;
    }
}
echo json_encode($staff_data, JSON_PRETTY_PRINT);

?>
