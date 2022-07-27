<?php 
    include("../../dbconfig.php");
    include("../../config.php");
    $upload_dir = "../../../assets/images/profile_pics/";
    // get image from user's computer
    if(isset($_FILES["file"]))
    {
        // check file size
        if($_FILES["file"]["size"] > 1000000)
        {
            echo "File size is too big";
            exit();
        }
        // check file type
        $allowed = array("jpg", "jpeg", "png");
        $file_name = $_FILES["file"]["name"];
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        if(!in_array($file_ext, $allowed))
        {
            echo "File type is not allowed";
            exit();
        }
        // upload file
        $file_name_new = $_SESSION['user_id'] . "." . $file_ext;
        $file_destination = $upload_dir . $file_name_new;
        move_uploaded_file($_FILES["file"]["tmp_name"], $file_destination);
        // update database
        $query = "UPDATE users SET profilePhoto = 'assets/images/profile_pics/$file_name_new' WHERE username = '$_SESSION[user_id]'";
        mysqli_query($connection, $query);
        return false;
    } else {
        echo "No file data received";
    }
?>