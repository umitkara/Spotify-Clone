<?php 
include("includes/include_files.php");
$user = new User($connection, $_SESSION['user_id']);
?>

<div class="userDetails">
    <div class="detailContainer">
        <h2>E-mail</h2>
        <input type="text" class="email" name="email" value="<?php echo $user->get_email(); ?>">
        <span class="message"></span>
        <button class="button green" onclick="update_email()">
            Update E-mail
        </button>
    </div>
    <div class="detailContainer">
        <h2>Password</h2>
        <input name="oldPassword" type="password" placeholder="Old Password">
        <input name="newPassword" type="password" placeholder="New Password">
        <input name="confirmPassword" type="password" placeholder="Confirm Password">
        <span class="message"></span>
        <button class="button green" onclick="update_password()">
            Update Password
        </button>
    </div>
    <div class="detailContainer">
        <h2>Account</h2>
        <button class="button red" onclick="delete_account()">
            Delete Account
        </button>
    </div>
</div>