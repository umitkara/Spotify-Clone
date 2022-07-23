<?php

include("includes/dbconfig.php");
include("includes/config.php");

if(isset($_SESSION['user_id']))
{
    header("Location: index.php");
}

include("includes/classes/Account.php");

$account = new Account($connection);

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
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body>
    <div class="container">
        <div class="input-container">
            <div class="login-container">
                <form id="loginForm" action="register.php" method="POST">
                    <h2>Login to Spotify Clone</h2>
                    <p>
                        <?php echo $account->get_error_span("loginUsername") ?>
                        <label for="loginUsername">Username:</label>
                        <input type="text" name="loginUsername" id="loginUsername" placeholder="Username" value="<?php get_input_value("loginUsername") ?>" required>
                    </p>
                    <p>
                        <?php echo $account->get_error_span("loginPassword") ?>
                        <label for="loginPassword">Password:</label>
                        <input type="password" name="loginPassword" id="loginPassword" placeholder="Password" required>
                    </p>
                    <p>
                        <input type="submit" value="Login" name="login">
                    </p>
                    <div id="switch-forms">
                        <p>
                            Don't have an account? <a id="show-register" href="#">Register</a>
                        </p>
                    </div>
                </form>
                <form id="registerForm" action="register.php" method="POST">
                    <h2>Create Spotify Clone account</h2>
                    <p>It's free</p>
                    <p>
                        <?php echo $account->get_error_span("username1") ?>
                        <?php echo $account->get_error_span("username2") ?>
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" placeholder="Username" value="<?php get_input_value("username") ?>" required>
                    <p>
                        <?php echo $account->get_error_span("firstname") ?>
                        <label for="firstname">Firstname:</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Firstname" value="<?php get_input_value("firstname") ?>" required>
                    <p>
                        <?php echo $account->get_error_span("lastname") ?>
                        <label for="lastname">Lastname:</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Lastname" value="<?php get_input_value("lastname") ?>" required>
                    <p>
                        <?php echo $account->get_error_span("email1") ?>
                        <?php echo $account->get_error_span("email2") ?>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Email" value="<?php get_input_value("email") ?>" required>
                    <p>
                        <?php echo $account->get_error_span("password2") ?>
                        <?php echo $account->get_error_span("password3") ?>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Password" value="<?php get_input_value("password") ?>" required>
                    <p>
                        <?php echo $account->get_error_span("password1") ?>
                        <label for="passwordConfirm">Confirm password:</label>
                        <input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="Confirm password" value="<?php get_input_value("passwordConfirm") ?>" required>
                    <p>
                        <input type="submit" value="Register" name="register">
                    </p>
                    <div id="switch-forms">
                        <p>
                            Already have an account? <a id="show-login" href="#">Login</a>
                        </p>
                    </div>
                </form>
            </div>
            <div class="content">
                <h1>
                    Get great music,
                    <br>
                    right now
                </h1>
                <h2>
                    Listen to loads of songs for free.
                </h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlist</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <script src="assets/js/register.js"></script>
    <?php
    if (isset($_POST['register'])) {
        echo <<<END
        <script>
        $(document).ready(function() {
            $("#loginForm").hide();
            $("#registerForm").show();
        });
        </script>
        END;
    } 
    else {
        echo <<<END
        <script>
        $(document).ready(function() {
            $("#registerForm").hide();
            $("#loginForm").show();
        });
        </script>
        END;
    }
    
    ?>
</body>

</html>