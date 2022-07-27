<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["email"]) && isset($_POST["username"]))
    {
        $email = strtolower($_POST["email"]);
        $username = $_POST["username"];
        $user_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
        $user = mysqli_fetch_assoc($user_query);
        // if email is same return
        if($user['email'] == $email)
        {
            echo "Email not changed. Please enter a different email.";
        }
        $user_id = $user['id'];
        $query = mysqli_query($connection, "UPDATE users SET email = '$email' WHERE id = '$user_id'");
        return false;
    } else {
        echo "Error";
    }
?>