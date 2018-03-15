<?php
header("Content-type: text/css; charset: UTF-8");
include 'config.php';
$debug = 0;
include 'includes/functions.php';
include 'includes/fixes.php';
if ( file_exists('themes/'.$_GET['theme'].'/overrides.php') ) {
    include 'themes/'.$_GET['theme'].'/overrides.php';
}
if (!empty($_GET['steamid'])) {
    include 'includes/mysql.php';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conn->connect_error) {
        errorlog('[MySQL Error] - ' . $conn->connect_error);
    }
    getUser($_GET['steamid']);
}
?>

body {
    color: <?php echo $color['font'];?>;
    background-color: <?php echo $color['background'];?>;
    <?php
    if (isset($user_bg_type)) {$background['type'] = $user_bg_type;}
    if ($background['type'] >=2 && !empty($background['image'])) {echo 'background-image:url('.$background['image'].') !important;' . "\n";}
    ?>
}
.primary-color {background-color: <?php echo $color['primary'];?>;}
.primary-color-text {color: <?php echo $color['primary'];?>;}
.secondary-color {background-color: <?php echo $color['secondary'];?>;}
.secondary-color-text {color: <?php echo $color['secondary'];?>;}
<?php if (file_exists('themes/'.$_GET['theme'].'/'.$_GET['theme'].'.css')) {include 'themes/'.$_GET['theme'].'/'.$_GET['theme'].'.css';} ?>
