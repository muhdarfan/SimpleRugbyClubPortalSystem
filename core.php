<?php
define("BASE", dirname(__FILE__));
include 'config.php';
include 'classes/database.php';
include 'classes/Utils.php';

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

// Initialize Database
$DB = new MysqliDb($Config['Database']['host'], $Config['Database']['user'], $Config['Database']['pass'], $Config['Database']['db']);
$DB->setTrace (true); // Debug

if (isset($_SESSION['loggedin'])) {
    $ID = intval($_SESSION['id']);

    if (isset($_SESSION['user'])) {
        $DB->where('userID', $ID);
        $User = $DB->objectBuilder()->getOne('tbl_users');
    } elseif (isset($_SESSION['admin'])) {
        $DB->where('adminID', $ID);
        $User = $DB->objectBuilder()->getOne('tbl_admin');
    }

    if (empty($User)) {
        session_destroy();
    }
} else {
    if (strpos($_SERVER['SCRIPT_NAME'], "/user/") !== false && $_SERVER['SCRIPT_NAME'] != "/user/login.php") {
        header("LOCATION: /user/login.php");
    } elseif (strpos($_SERVER['SCRIPT_NAME'], "/admin/") !== false && $_SERVER['SCRIPT_NAME'] != "/admin/login.php") {
        header("LOCATION: /admin/login.php");
    }
}
?>