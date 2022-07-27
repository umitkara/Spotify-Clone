<?php 
    include("../../dbconfig.php");
    include("../../config.php");

    if(isset($_POST["old_password"]) && isset($_POST["new_password"]) && isset($_POST["username"]))
    {
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $username = $_POST["username"];
        $user_query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$username'");
        $user = mysqli_fetch_assoc($user_query);
        if(!password_verify($old_password, $user["password"]))
        {
            echo "Current password is incorrect.";
            exit();
        }
        $user_id = $user['id'];
        $query = mysqli_query($connection, "UPDATE users SET password = '$new_password_hash' WHERE id = '$user_id'");
        return false;
    } else {
        echo "Error";
    }
?>