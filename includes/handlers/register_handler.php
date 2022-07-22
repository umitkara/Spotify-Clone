<?php

function clean_form_username($username): string
{
    $username = strip_tags($username);
    $username = str_replace(" ", "", $username);
    return $username;
}

function clean_form_string($string): string
{
    $string = strip_tags($string);
    $string = str_replace(" ", "", $string);
    $string = str_replace("\n", "", $string);
    $string = ucfirst(strtolower($string));
    return $string;
}

function clean_form_password($password): string
{
    $password = strip_tags($password);
    return $password;
}

if (isset($_POST['register'])) {
    $username = clean_form_username($_POST['username']);
    $firstname = clean_form_string($_POST['firstname']);
    $lastname = clean_form_string($_POST['lastname']);
    $email = clean_form_string($_POST['email']);
    $password = clean_form_password($_POST['password']);
    $passwordConfirm = clean_form_password($_POST['passwordConfirm']);


    $registerResutlt = $account->register($username, $firstname, $lastname, $email, $password, $passwordConfirm);

    if($registerResutlt == true)
    {
        echo "Registration successful";
        // redirect to index.php
    }
    else {
        echo "Registration failed";
        // redirect to something went wrong page?
    }
}

?>