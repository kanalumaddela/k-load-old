<?php
    if (empty($theme)) {
        die('get out'); // prevents direct access to file
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>Theme Name Here (not needed in reality) | K-Load</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="assets/css/load.css" rel="stylesheet">
    <link href="css.php?theme=<?php echo $theme.'&steamid='.$_GET['steamid']; ?>" rel="stylesheet">
</head>
<body>
<script src="//code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js"></script>
<script src="assets/js/load.js"></script>
</body>
</html>
