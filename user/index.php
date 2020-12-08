<?php
include "../core.php";
if (isset($_SESSION['user'])) {
    header("LOCATION: home.php");
} else {
    header("LOCATION: login.php");
}
?>