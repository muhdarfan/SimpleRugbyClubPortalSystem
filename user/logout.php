<?php
include_once '../core.php';

session_destroy();
header('Refresh: 5; URL=login.php');
?>
<html>
<body>
You've been successfully logged out.
</body>
</html>