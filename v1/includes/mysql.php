<?php
function testConnection() {
    global $mysql;
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conn->connect_error) {
        echo '[MySQL Error] - ' . $conn->connect_error;
        errorlog('[MySQL Error] - testConnection(): ' . $conn->connect_error);
    } else {
        return $conn;
    }
}
function createDB() {
    global $mysql;
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
    $query = "CREATE DATABASE IF NOT EXISTS " . DB_DATABASE;
    if ($conn->query($query) === TRUE) {
        echo "<h5>MySQL DB has been created/already exists</h5>";
        echo "<h5>Please proceed to setup the tables</h5>";
    } else {
        echo "Error creating database, please check the logs<br/>";
        errorlog('[MySQL Error] - createDB(): ' . $conn->error);
    }
}
function createTables() {
    global $conn, $color,$volume;
    if (!$conn) {return;}
    $query = "CREATE TABLE IF NOT EXISTS ".DB_TABLE."(
                id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(25) NOT NULL,
                steamid VARCHAR(30) UNIQUE NOT NULL,
                steam64 VARCHAR(30) UNIQUE NOT NULL,
                banned TINYINT(1) NOT NULL DEFAULT 0,
                theme VARCHAR(30) NOT NULL,
                background_type TINYINT(1) UNSIGNED NOT NULL DEFAULT 1,
                background_image VARCHAR(50) NULL DEFAULT NULL,
                background_color char(6) NOT NULL DEFAULT '".substr($color['background'], 1)."',
                font_color char(6) NOT NULL DEFAULT '".substr($color['font'], 1)."',
                primary_color char(6) NOT NULL DEFAULT '".substr($color['primary'], 1)."',
                secondary_color char(6) NOT NULL DEFAULT '".substr($color['secondary'], 1)."',
                volume TINYINT(1) UNSIGNED NOT NULL DEFAULT ".$volume.",
                music_choice TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
                youtube_playlist VARCHAR(50) NULL DEFAULT NULL
            ) DEFAULT CHARSET=utf8";
    if ($conn->query($query) == TRUE) {
        echo "<h4>Tables created</h4>";
    } else {
        echo "<h4>Failed to create tables/tables already created, please check the logs</h4>";
        errorlog('[MySQL Error] - createTables(): ' . $conn->error);
    }
}
function wipeTables() {
    global $conn, $color,$volume;
    if (!$conn) {return;}
    $query = "DROP TABLE ".DB_TABLE;
    if ($conn->query($query) == TRUE) {
        echo "<h4>Tables dropped. Please recreate them.</h4>";
    } else {
        echo "Failed to drop tables, please check the logs";
        errorlog('[MySQL Error] - wipeTables(): ' . $conn->error);
    }
}
function addUser($steam64,$name) {
    global $conn,$theme,$color,$volume;
    if (!$conn) {return;}
    
    $query = "INSERT IGNORE INTO `".DB_TABLE."` (name, steamid, steam64, theme, background_color, font_color, primary_color, secondary_color, volume)
                    VALUES (
                        '".$conn->real_escape_string($name)."',
                        '".$conn->real_escape_string(steam64_to_steamid($steam64))."',
                        '".$conn->real_escape_string($steam64)."',
                        '$theme',
                        '".substr($color['background'], 1)."',
                        '".substr($color['font'], 1)."',
                        '".substr($color['primary'], 1)."',
                        '".substr($color['secondary'], 1)."',
                        '$volume'
                    )";
    if ($conn->query($query) != TRUE) {
        errorlog('[MySQL Error] - addUser('.$steam64.', '.$name.'): ' . $conn->error);
    }
}
function deleteUser($steam64) {
    global $conn,$admin_id;
    if (!$conn) {return;}
    
    $query = "DELETE FROM `".DB_TABLE."` WHERE steam64 = '".$conn->real_escape_string($steam64)."'";
    if ($conn->query($query) === TRUE) {
        echo '<h4>'.$steam64.' has been deleted from the database</h4>';
    } else {
        echo '<h4>Failed to delete user, please check the logs</h4>';
        errorlog('[MySQL Error] - deleteUser('.$steam64.'): ' . $conn->error);
    }
}
function banUser($steamid) {
    global $conn,$admin_id;
    if (!$conn) {return;}
    if ($steamid == steam64_to_steamid($admin_id) ) {echo '<h4>You cannot ban yourself!</h4>';return;}
    
    $query = "UPDATE ".DB_TABLE." SET banned = 1 WHERE steamid = '".$conn->real_escape_string($steamid)."'";
    if ($conn->query($query) === TRUE) {
        echo '<h4>'.$steamid.' has been banned</h4>';
    } else {
        echo '<h4>Failed to ban user, please check the logs</h4>';
        errorlog('[MySQL Error] - banUser('.$steamid.'): ' . $conn->error);
    }
}
function unbanUser($steamid) {
    global $conn;
    if (!$conn) {return;}
    
    $query = "UPDATE ".DB_TABLE." SET banned = 0 WHERE steamid = '".$conn->real_escape_string($steamid)."'";
    if ($conn->query($query) === TRUE) {
        echo '<h4>'.$steamid.' has been unbanned</h4>';
    } else {
        echo '<h4>Failed to unban user, please check the logs</h4>';
        errorlog('[MySQL Error] - unbanUser('.$steamid.'): ' . $conn->error);
    }
}
function getUserTheme($steam64) {
    global $conn,$theme;
    if (!$conn) {return;}
    
    $query = "SELECT `theme` FROM `".DB_TABLE."` WHERE `steam64` = '".$conn->real_escape_string($steam64)."'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $theme = $row["theme"];
    } else {
        errorlog('[MySQL Error] - getUser('.$steam64.'): ' . $conn->error);
    }
}
function getUser($steam64) {
    global $conn,$banned,$theme,$user_bg_type,$background,$color,$user_volume,$user_music_type,$user_ytplaylist,$soundcloud_id;
    if (!$conn) {return;}

    $query = "SELECT * FROM `".DB_TABLE."` WHERE `steam64` = '".$conn->real_escape_string($steam64)."'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $banned = (int)$row['banned'];
        $theme = $row["theme"];
        $user_bg_type = (int)$row['background_type'];
        $background['image'] = $row['background_image'];
        $color['background'] = '#'.$row["background_color"];
        $color['font'] = '#'.$row["font_color"];
        $color['primary'] = '#'.$row["primary_color"];
        $color['secondary'] = '#'.$row["secondary_color"];
        $user_volume = (int)$row["volume"];
        $user_music_type = (int)$row["music_choice"];
        $user_ytplaylist = $row["youtube_playlist"];
    } else {
        errorlog('[MySQL Error] - getUser('.$steam64.'): ' . $conn->error);
    }
}
function updateTheme($steam64, $theme_choice, $background_type, $background_image, $color_background, $color_font, $color_primary, $color_secondary ) {
    global $conn,$color,$theme,$background;
    if (!$conn) {return;}
    
    if ( !empty($theme_choice) ) { $theme = $theme_choice; }
    if ( !empty($background_image) ) { $background['image'] = 'https://i.imgur.com/'.$background_image; }
    if ( !empty($color_background) ) { $color['background'] = $color_background; }
    if ( !empty($color_font) ) { $color['font'] = $color_font; }
    if ( !empty($color_primary) ) { $color['primary'] = $color_primary; }
    if ( !empty($color_secondary) ) { $color['secondary'] = $color_secondary; }
    
    $query = "UPDATE `".DB_TABLE."` SET `theme`= '".$conn->real_escape_string($theme). "' , `background_type`= ".$conn->real_escape_string($background_type).", `background_image`= '".$conn->real_escape_string($background['image'])."', `background_color`= '".$conn->real_escape_string($color['background'])."' , `font_color`= '".$conn->real_escape_string($color['font'])."' , `primary_color`= '".$conn->real_escape_string($color['primary'])."' , `secondary_color`= '".$conn->real_escape_string($color['secondary'])."' WHERE `steam64`= '".$conn->real_escape_string($steam64)."'";
    if ($conn->query($query) === TRUE) {
        echo '<h4>Your theme settings have been saved.</h4>';
    } else {
        echo '<h4>Failed to save, please have the owner check the logs</h4>';
        errorlog('[MySQL Error] - updateTheme('.$steam64.','.$theme.','.$background_type.','.$background_image.','.$color['background'].','.$color['font'].','.$color['primary'].','.$color['secondary'].'): ' . $conn->error);
    }
}
function updateMedia($steam64, $volume_choice, $music_choice, $yt_choice) {
    global $conn,$volume;
    if (!$conn) {return;}
        
    $query = "UPDATE `".DB_TABLE."` SET `volume`= '".$conn->real_escape_string($volume_choice). "' , `music_choice`= ".$conn->real_escape_string($music_choice).", `youtube_playlist`= '".$conn->real_escape_string($yt_choice)."' WHERE `steam64`= '".$conn->real_escape_string($steam64)."'";
    if ($conn->query($query) === TRUE) {
        echo '<h4>Your media settings have been saved.</h4>';
    } else {
        echo '<h4>Failed to save, please have the owner check the logs</h4>';
        errorlog('[MySQL Error] - updateMedia('.$steam64.','.$volume_choice.','.$yt_choice.','.$sc_choice.'): ' . $conn->error);
    }
}
function getUserList() {
    global $conn;
    if (!$conn) {return;}
    
    $query = "SELECT `name`,`theme`,`background_image`,`background_color`,`font_color`,`primary_color`,`secondary_color`,`youtube_playlist` FROM ".DB_TABLE;
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        echo '<table class="bordered responsive-table"><thead><tr><th>Name</th><th>Theme</th><th>Image</th><th>Colors</th><th>Youtube Playlist</th></tr></thead><tbody>';
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>'.$row['name'].'</td>';
            echo '<td>'.$row['theme'].'</td>';
            if ( empty($row['background_image']) ) {
                echo '<td>No image set</td>';
            } else {
                echo '<td>'.$row['background_image'].'</td>';
            }
            echo '<td><span style="color:#'.$row['background_color'].';">'.$row['background_color'].'<span class="white-text">-</span></span><span style="color:#'.$row['font_color'].';">'.$row['font_color'].'<span class="white-text">-</span></span><span style="color:#'.$row['primary_color'].';">'.$row['primary_color'].'<span class="white-text">-</span></span><span style="color:#'.$row['secondary_color'].';">'.$row['secondary_color'].'</span></td>';
            if ( empty($row['youtube_playlist']) ) {
                echo '<td>No playlist set</td>';
            } else {
                echo '<td>https://www.youtube.com/playlist?list='.$row['youtube_playlist'].'</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        errorlog('[MySQL Error] - getUserList(): ' . $conn->error);
    }
}
?>