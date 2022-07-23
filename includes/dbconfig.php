<?php 

    ob_start(); // Output Buffering Start. Prevents header from being sent twice.
    
    $timezone = date_default_timezone_set("Europe/Istanbul"); // Set the default timezone.

    $connection = mysqli_connect("localhost", "root", "", "spotify"); // Establish a connection to the database.

    if(mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_errno();
    }
?>