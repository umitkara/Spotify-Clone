<?php

include("includes/classes/Account.php");

$account = new Account();

include("includes/handlers/register_handler.php");
include("includes/handlers/login_handler.php");

function get_input_value($name)
{
    if(isset($_POST[$name]))
    {
        echo $_POST[$name];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Spotify Clone</title>
</head>

<body>
    <div>
        <form id="loginForm" action="register.php" method="POST">
            <h2>Login to Spotify Clone</h2>
            <p>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
            </p>
            <p>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
            </p>
            <p>
                <input type="submit" value="Login" name="login">
            </p>
        </form>

        <form id="registerForm" action="register.php" method="POST">
            <h2>Create Spotify Clone account</h2>
            <p>It's free</p>
            <p>
                <?php echo $account->get_error_span("username") ?>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" value="<?php get_input_value("username") ?>" required>
            </?php>
            <p>
                <?php echo $account->get_error_span("firstname") ?>
                <label for="firstname">Firstname:</label>
                <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="<?php get_input_value("firstname") ?>" required>
            </?php>
            <p>
                <?php echo $account->get_error_span("lastname") ?>
                <label for="lastname">Lastname:</label>
                <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="<?php get_input_value("lastname") ?>" required>
            </?php>
            <p>
                <?php echo $account->get_error_span("email") ?>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" value="<?php get_input_value("email") ?>" required>
            </?php>
            <p>
                <?php echo $account->get_error_span("password2") ?>
                <?php echo $account->get_error_span("password3") ?>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Password" value="<?php get_input_value("password") ?>" required>
            </?php>
            <p>
                <?php echo $account->get_error_span("password1") ?>
                <label for="passwordConfirm">Confirm password:</label>
                <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm password" value="<?php get_input_value("passwordConfirm") ?>" required>
            </?php>
            <p>
                <input type="submit" value="Register" name="register">
            </p>
        </form>
    </div>
</body>

</html>