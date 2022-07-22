<?php
class Account {

    private $errors;

    public function __construct()
    {
        $this->errors = array();
    }

    public function register(string $username, string $firstname, string $lastname, string $email, string $password, string $passwordConfirm)
    {
        $this->validate_username($username);
        $this->validate_firstname($firstname);
        $this->validate_lastname($lastname);
        $this->validate_email($email);
        $this->validate_password($password, $passwordConfirm);
        
        if(empty($this->errors))
        {
            // Add user to database
            return true;
        }
        else {
            return false;
        }
    }

    private function validate_username($username): void
    {
        if(strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errors, "Username must be between 5 and 25 characters");
        }
        // Check if username already exist
    }

    private function validate_firstname($firstname): void
    {
        if(strlen($firstname) > 25 || strlen($firstname) < 2) {
            array_push($this->errors, "Firstname must be between 2 and 25 characters");
        }
    }

    private function validate_lastname($lastname): void
    {
        if(strlen($lastname) > 25 || strlen($lastname) < 2) {
            array_push($this->errors, "Lastname must be between 2 and 25 characters");
        }
    }

    private function validate_email($email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, "Email is invalid");
        }
        // Check if email already exist
    }

    private function validate_password($password1, $password2): void
    {
        if($password1 != $password2) {
            array_push($this->errors, "Passwords do not match");
        }
        if(strlen($password1) > 25 || strlen($password1) < 5) {
            array_push($this->errors, "Password must be between 5 and 25 characters");
        }
        if(preg_match('/[^A-Za-z0-9]/', $password1)) {
            array_push($this->errors, "Password must only contain letters and numbers");
        }
    }
}
?>