<?php

include("includes/dbconfig.php");
include("includes/config.php");


if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
}
else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify</title>
</head>
<body>
    
</body>
</html>