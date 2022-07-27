<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["username"]))
    {
        $username = $_POST["username"];
        $user_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
        $user = mysqli_fetch_assoc($user_query);
        if(!$user)
        {
            echo "Username does not exist.";
            exit();
        }
        setcookie('user_id', '', 0, '/');
        session_destroy();
        $user_id = $user['id'];
        $query = mysqli_query($connection, "DELETE FROM users WHERE id = '$user_id'");
        return false;
    } else {
        echo "Error";
    }
?>