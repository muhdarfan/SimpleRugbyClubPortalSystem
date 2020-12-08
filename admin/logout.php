<?php
include '../core.php';

session_destroy();
header('Refresh: 5; URL=login.php');
?>
You've been successfully logged out.