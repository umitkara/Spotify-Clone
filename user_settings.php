<?php 
include("includes/include_files.php");
$user = new User($connection, $_SESSION['user_id']);
?>

<div class="userDetails">
    <div class="detailContainer">
        <h2>Name</h2>
        <div class="nameDetails">
            <label for="firstName">First Name</label>
            <input id="firstName" type="text" name="firstName" value="<?php echo $user->get_first_name(); ?>">
            <label for="lastName">Last Name</label>
            <input id="lastName" type="text" name="lastName" value="<?php echo $user->get_last_name(); ?>">
        </div>
        <span id="nameMessage" class="message"></span>
        <button class="button green" onclick="update_name()">
            Update
        </button>
    </div>
    <div class="detailContainer">
        <h2>E-mail</h2>
        <input id="email" type="text" class="email" name="email" value="<?php echo lcfirst($user->get_email()); ?>">
        <span id="emailMessage" class="message"></span>
        <button class="button green" onclick="update_email()">
            Update E-mail
        </button>
    </div>
    <div class="detailContainer">
        <h2>Password</h2>
        <input id="oldPassword" name="oldPassword" type="password" placeholder="Current Password">
        <input id="newPassword" name="newPassword" type="password" placeholder="New Password">
        <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm Password">
        <span id="passwordMessage" class="message"></span>
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