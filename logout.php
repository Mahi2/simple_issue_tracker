<?php

/* LOGOUT */

include('setup/config.php');
session_start();
$_SESSION['error'] = '';
$sessionname = md5($USER.$SALT);
$_SESSION[$sessionname] = FALSE;
session_unset();
session_destroy();
header('Location: index.php');
