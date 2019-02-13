<?php

//Version 3.2

// System stuff
if (empty($steamauth['domainname'])) {
    $steamauth['domainname'] = $_SERVER['SERVER_NAME'];
}
if (empty($steamauth['logoutpage'])) {
    $steamauth['logoutpage'] = $_SERVER['PHP_SELF'];
}
if (empty($steamauth['loginpage'])) {
    $steamauth['loginpage'] = $_SERVER['PHP_SELF'];
}
