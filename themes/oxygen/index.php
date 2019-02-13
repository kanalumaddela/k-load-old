<?php
    if (empty($theme)) {
        die('get out'); // prevents direct access to file
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Oxygen | K-Load</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300|Material+Icons">
    <link rel="stylesheet" href="assets/css/load.css">
    <link rel="stylesheet" href="css.php?theme=<?php echo $theme.'&steamid='.$_GET['steamid']; ?>">
</head>
<body>
<?php overlay(); ?>
<div id="wrapper">
    <div>
        <?php userAvatar(''); ?>
    </div>
    <div id="content">
        <div class="block one">
            <div><i class="material-icons">map</i></div>
            <span id="mapname">de_dust</span>
        </div>
        <div class="spacer vertical"></div>
        <div class="block two">
            <div><i class="material-icons">videogame_asset</i></div>
            <span id="gamemode">terrortown</span>
        </div>
        <div class="spacer vertical"></div>
        <div class="block three">
            <div><i class="material-icons">group</i></div>
            <span id="maxplayers">24</span>
        </div>
        <div class="spacer vertical"></div>
        <div class="block four">
            <div><i class="material-icons">schedule</i></div>
            <span id="percentage">64%</span>
        </div>
    </div>
</div>
<script src="//code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="assets/js/load.js"></script>
</body>
</html>
