<?php
    if (empty($theme)) {
        die('get out'); // prevents direct access to file
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Simple | K-Load</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="//fonts.googleapis.com/css?family=Raleway:100,400" rel="stylesheet">
    <link href="assets/css/load.css" rel="stylesheet">
    <link href="css.php?theme=<?php echo $theme.'&steamid='.$_GET['steamid']; ?>" rel="stylesheet">
</head>
<body>
<style>
body {
    font-family: 'Raleway';
    text-align: center;
    text-shadow: 0px 2px 2px rgba(0, 0, 0, 0.65);
}
p {
    font-size: 2rem;
    margin: 10px;
}
#useravatar {
    margin: 0px auto 10px;
}
</style>
<?php overlay(); ?>
<div id="wrapper">
    <?php userAvatar('useravatar circle'); ?>
    <p><?php echo $steamprofile['personaname']; ?></p>
    <?php loadingBar(60); ?>
    <?php messages(); ?>
</div>
<script src="//code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="assets/js/load.js"></script>
</body>
</html>
