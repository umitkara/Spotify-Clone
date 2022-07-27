<?php

if (isset($_POST['login'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $result = $account->login($username, $password);

    if ($result) {
        // Not secure. Maybe hash or uuid?
        $_SESSION['user_id'] = $username;
        $cookie_name = "user_id";
        $cookie_value = $username;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        header("Location: index.php");
    }
}

?>