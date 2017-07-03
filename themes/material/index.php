<?php
    if (empty($theme)) {
        die('get out'); // prevents direct access to file
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Material | K-Load</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="assets/css/materialize.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Material+Icons">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/load.css">
    <link rel="stylesheet" href="css.php?theme=<?php echo $theme.'&steamid='.$_GET['steamid']; ?>">
</head>
<body>
    <nav>
        <div class="nav-wrapper secondary-color">
            <a id="server_name" href="./" class="brand-logo center flow-text">Server Name</a>
        </div>
    </nav>

    <div id="content" class="row wrapper">
        <div id="rulesblock" class="col s12 m3 hide-on-small-only primary-color">
            <h5>Rules</h5>
            <ul id="rules">
            </ul>
        </div>
        <div id="spacer" class="col m1 hide-on-small-only"></div>
        <div id="contentblock" class="col s12 m8 primary-color">
            <div class="col s12" style="margin-bottom: 10px;">
                <span id="clientstatus" class="flow-text center truncate">Downloading...</span>
                <div class="progressbar">
                    <div id="loadingbar" class="secondary-color"><span id="percentage" class="white-text">100%</span></div>
                </div>
            </div>
            <div id="mapblock" class="col s7">
                <?php mapImage(); ?>
                <div id="mapname" class="col s12 center"><?php echo $mapame; ?></div>
                <div id="messageblock" class="col s12 center"> <h5 id="messages" class="flow-text"></h5></div>
            </div>
            <div class="col s5">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <i class="material-icons circle z-depth-1 purple">person</i>
                        <div style="text-align: right;">
                            <span class="title"><?php echo $steamprofile['personaname']; ?></span>
                            <p><?php echo $steamid; ?></p>
                        </div>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle z-depth-1 teal darken-3">videogame_asset</i>
                        <div style="text-align: right;">
                            <span class="title">Gamemode</span>
                            <p id="gamemode"></p>
                        </div>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle z-depth-1 grey darken-4">group</i>
                        <div style="text-align: right;">
                            <span class="title">Maxplayers</span>
                            <p id="maxplayers"></p>
                        </div>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle z-depth-1 brown darken-4">folder</i>
                        <div style="text-align: right;">
                            <span class="title">Total Server Files</span>
                            <p id="files_total"></p>
                        </div>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle z-depth-1" style="background-color:#ff9800;">find_in_page</i>
                        <div style="text-align: right;">
                            <span class="title">Files Needed</span>
                            <p id="files_needed"></p>
                        </div>
                    </li>
                    <li class="collection-item avatar">
                        <i class="material-icons circle z-depth-1" style="background-color:#e53935;">cloud_download</i>
                        <div style="text-align: right;">
                            <span class="title">Files Downloaded</span>
                            <p id="files_downloaded"></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<script src="//code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="assets/js/load.js"></script>
</body>
</html>
