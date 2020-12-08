<?php
include '../core.php';

if (!isset($_SESSION['admin']))
    header("LOCATION: login.php");
else
    header("LOCATION: home.php");
?>