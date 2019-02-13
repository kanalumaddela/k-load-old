<?php

require '../config.php';
require '../includes/functions.php';
require '../includes/fixes.php';
require '../includes/mysql.php';
require '../includes/steamauth/steamauth.php';

if ($_SERVER['QUERY_STRING'] == 'playlist') {
    echo 'https://www.youtube.com/watch?v=Y6ljFaKRTrI&list=PLM9DkUx04Ya12mPqj-hAUmzjv_E-XSc3b'.'</br>';
    echo 'https://www.youtube.com/watch?v=Y6ljFaKRTrI&list=PLM9DkUx04Ya12mPqj-hAUmzjv_E-XSc3b - <strong>'.getYouTubePlaylistID('https://www.youtube.com/watch?v=Y6ljFaKRTrI&list=PLM9DkUx04Ya12mPqj-hAUmzjv_E-XSc3b').'</strong></br>';
    echo 'https://www.youtube.com/watch?list=PLM9DkUx04Ya12mPqj-hAUmzjv_E-XSc3b - <strong>'.getYouTubePlaylistID('https://www.youtube.com/watch?list=PLM9DkUx04Ya12mPqj-hAUmzjv_E-XSc3b').'</strong>';
    die();
}
if ($_SERVER['QUERY_STRING'] == 'imgur') {
    if (preg_match('#^.+/([^/]+)(\.[^/]+)?$#', 'https://i.imgur.com/26xcQUF.jpg', $matches)) {
        var_dump($matches);
    }
    echo '<br/>'.substr($matches[1], 0, -4).'<br/>';
    print_r(parse_url('https://i.imgur.com/26xcQUF.jpg'));
    echo '<br/>';
    echo getImgurID('https://i.imgur.com/26xcQUF.jpg');
    die();
}

if (isset($_POST) && isset($_SESSION['steamid'])) {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conn->connect_error) {
        errorlog('[MySQL Error] - '.$conn->connect_error);
        die('<h5>There was an issue connecting to the MySQL server. Please check the error logs.</h5>');
    }
    if ($_SESSION['steamid'] == $admin_id && $_POST['type'] == 'admin') {
        switch ($_POST['action']) {
            case 'test_conn':
                echo '<h5>Connection successful</h5>';
                break;
            case 'create_db':
                createDB();
                break;
            case 'create_tables':
                createTables();
                break;
            case 'wipe_tables':
                wipeTables();
                break;
            case 'wipe_logs':
                wipeLogs();
                break;
            case 'ban_user':
                banUser($_POST['data'][0]);
                break;
            case 'unban_user':
                unbanUser($_POST['data'][0]);
                break;
            default:
                echo "That action isn't defined!";
        }
    } else {
        switch ($_POST['action']) {
            case 'save_theme':
                updateTheme($_SESSION['steamid'], $_POST['data'][0], $_POST['data'][1], getImgurIDwExt($_POST['data'][2]), $_POST['data'][3], $_POST['data'][4], $_POST['data'][5], $_POST['data'][6]);
                break;
            case 'save_media':
                updateMedia($_SESSION['steamid'], $_POST['data'][0], $_POST['data'][1], getYouTubePlaylistID($_POST['data'][2]));
                break;
            default:
                break;
        }
    }
}
