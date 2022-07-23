<?php

if (isset($_POST['login'])) {
    $username = $_POST['loginUsername'];
    $password = $_POST['loginPassword'];

    $result = $account->login($username, $password);

    if ($result) {
        // Not secure. Maybe hash or uuid?
        $_SESSION['user_id'] = $username;
        header("Location: index.php");
    }
}

?>