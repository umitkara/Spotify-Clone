<?php
include("../../../includes/dbconfig.php");
include("../../../includes/config.php");
setcookie('user_id', '', 0, '/');
session_destroy();
echo false;
?>