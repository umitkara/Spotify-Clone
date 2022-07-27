<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["username"]))
    {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $username = $_POST["username"];
        $user_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
        $user = mysqli_fetch_assoc($user_query);
        $user_id = $user['id'];
        $query = mysqli_query($connection, "UPDATE users SET firstname = '$first_name', lastname = '$last_name' WHERE id = '$user_id'");
        return false;
    } else {
        echo "Error";
    }
?>