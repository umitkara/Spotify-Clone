<?php 
include("includes/include_files.php");
$user = new User($connection, $_SESSION['user_id']);
?>

<div class="entitiyInfo">
    <div class="centerSection">
        <div class="profilePicture">
            <img src="<?php echo $user->get_profile_photo(); ?>" draggable="false">
            <div class="changePictureOverlay" onclick="click_upload_profile_photo()">
                <label for="profilePhoto">
                    <i class="fa-regular fa-camera"></i>
                </label>
                <input type="file" name="profilePhoto" id="changeProfilePhotoPicker" accept="image/*" onchange="upload_profile_photo(this)">
            </div>
        </div>
        <h1>
            <?php echo $user->get_fullname(); ?>
        </h1>
        <button class="button green" onclick="open_page('user_settings.php')">
            User Settings
        </button>
        <button class="button red" onclick="logout()">
            Logout
        </button>
    </div>
</div>