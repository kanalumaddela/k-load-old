<?php
require '../config.php';
require '../includes/functions.php';
require '../includes/fixes.php';
require '../includes/steamauth/steamauth.php';

if (isset($_SESSION['steamid'])) {
    require '../includes/mysql.php';
    require '../includes/steamauth/userInfo.php';
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
    if ($conn->connect_error) {
        errorlog('[MySQL Error] - Failed to connect: '.$conn->connect_error);
    } else {
        addUser($steamprofile['steamid'], $steamprofile['personaname']);
        getUser($_SESSION['steamid']);
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title><?php if (!empty($steamprofile['steamprofile'])) {
    echo $steamprofile['steamprofile'].' - ';
}?>UserCP | K-Load</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="../assets/css/materialize.min.css">
    <link rel="stylesheet" href="//cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css" />
    <link rel="stylesheet" href="../assets/css/site.css">
</head>
<body class="gradient-background">
<?php
if (!isset($_SESSION['steamid'])) {
    echo '<div id="loginbox" class="row center animated fadeIn transition"><h3>Login is required</h3><div class="divider"></div>';
    loginbutton();
    echo '</div>';
} else {
    ?>
<!-- Side Nav -->
<ul id="sideNav" class="side-nav fixed<?php if (!isset($_SESSION['logged_in'])) {
        echo ' animated fadeInLeft';
    } ?>">
    <li>
        <div class="userView">
            <a href="<?php echo substr($steamprofile['profileurl'], 5); ?>" target="_blank"><img class="circle" src="<?php echo $steamprofile['avatarfull']; ?>"></a>
        </div>
    </li>
    <li><a class="center tooltipped" href="../?steamid=<?php echo $steamprofile['steamid']; ?>" style="color:inherit;" target="_blank" data-tooltip="Demo with your settings"><?php echo $steamprofile['personaname']; ?></a></li>
    <li><div class="divider"></div></li>
    <li><a href="./">Home</a></li>
    <?php echo '<li><a href="?logout">Logout</a></li>'."\n"; ?>
    <li><div class="divider"></div></li>
    <li><a class="subheader">User Tools</a></li>
    <li><a href="./?theming">Themes</a></li>
    <li><a href="./?media">Media</a></li>
    <li><a href="./?users">View Users</a></li>
    <?php
        if ($_SESSION['steamid'] == $admin_id) {
            echo '<li><div class="divider"></div></li>'."\n";
            echo '<li><a class="subheader">Admin Tools</a></li>'."\n";
            echo '<li><a href="./?admin">Home</a></li>'."\n";
            echo '<li><a href="./?logs">Error Logs</a></li>'."\n";
        } ?>
</ul>
<!-- Mobile Nav -->
<nav class="hide-on-med-and-up">
    <div class="nav-wrapper">
        <a href="#" data-activates="sideNav" class="button-collapse"><i class="mdi mdi-menu hide-on-large-only"></i></a>
        <a href="#" class="brand-logo center">UserCP</a>
    </div>
</nav>
<main class="<?php if (!isset($_SESSION['logged_in'])) {
            echo ' animated zoomIn';
            $_SESSION['logged_in'] = '1';
        } ?>">
    <div class="row">
    <?php
    if ($banned != 0) {
        echo '<div class="col s12"><div class="card"><div class="card-content"><h1>Uh-oh</h1></div><div class="card-action row"><h5>Looks like someone\'s banned</h5></div></div></div>';
    } else {
        include 'member.php';
    }
    if ($_SESSION['steamid'] == $admin_id && !empty($_SERVER['QUERY_STRING'])) {
        include 'admin.php';
    } ?>
    </div>
</main>
<?php
} ?>

<!-- Modal -->
<div id="modal_bottom" class="modal bottom-sheet">
    <div id="modal_bottom_text" class="modal-content">
        <h4></h4>
        <p></p>
    </div>
    <div id="modal_bottom_footer" class="modal-footer">
      <a class="modal-action modal-close btn">Ok</a>
    </div>
</div>

<script src="../assets/js/jquery-2.2.4.min.js"></script>
<script src="../assets/js/materialize.min.js"></script>
    <?php
    if ($_SERVER['QUERY_STRING'] == 'theming') {
        echo '<script src="../assets/js/jscolor.min.js"></script>';
    }
    ?>
<script src="../assets/js/site.min.js"></script>
</body>
</html>
