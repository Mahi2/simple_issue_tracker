<?php

/* CHECK LOGIN */

session_start();
if ( isset($_POST['u']) and isset($_POST['p']) ) {
    require('setup/config.php');
    if ( $_POST['u'] == $USER AND $_POST['p'] == $PASS ){
        // ADD salt for security
        $sessionname = md5($USER.$SALT);
        $_SESSION[$sessionname] = TRUE;
        $_SESSION['error'] = FALSE;
        header('location: index.php');
        exit;
    } else {
        $_SESSION['error'] = TRUE;
        header('location: login.php');
        exit;
    }
} else {
    $_SESSION['error'] = TRUE;
    header('location: login.php');
    exit;
}
