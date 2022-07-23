<?php
class Account {

    private $errors;
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
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
            return $this->insert_into_db($username, $firstname, $lastname, $email, $password);
        }
        else {
            return false;
        }
    }

    public function get_error_span($field)
    {
        if(!empty($this->errors[$field]))
        {
            return "<span class='error'>" . $this->errors[$field] . "</span>";
        }
        else {
            return "";
        }
    }

    private function insert_into_db(string $username, string $firstname, string $lastname, string $email, string $password)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $profilePhoto = "assets/images/profile_pics/default.png";
        $date = date("Y-m-d");

        $results = $this->connection->query("INSERT INTO users (username, firstname, lastname, email, password, registerDate, profilePhoto) VALUES ('$username', '$firstname', '$lastname', '$email', '$password', '$date', '$profilePhoto')");
        
        return $results;
    }

    private function validate_username($username): void
    {
        if(strlen($username) > 25 || strlen($username) < 5) {
            $this->errors['username1'] = "Username must be between 5 and 25 characters";
        }
        // Check if username already exist
        $username_check = $this->connection->query("SELECT username FROM users WHERE username = '$username'");
        if(mysqli_num_rows($username_check) > 0) {
            $this->errors['username2'] = "Username already exist";
        }
    }

    private function validate_firstname($firstname): void
    {
        if(strlen($firstname) > 25 || strlen($firstname) < 2) {
            $this->errors['firstname'] = "Firstname must be between 2 and 25 characters";
        }
    }

    private function validate_lastname($lastname): void
    {
        if(strlen($lastname) > 25 || strlen($lastname) < 2) {
            $this->errors['lastname'] = "Lastname must be between 2 and 25 characters";
        }
    }

    private function validate_email($email): void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email1'] = "Email is not valid";
        }
        // Check if email already exist
        $emial_check = $this->connection->query("SELECT email FROM users WHERE email = '$email'");
        if (mysqli_num_rows($emial_check) > 0) {
            $this->errors['email2'] = "Email already exist";
        }
    }

    private function validate_password($password1, $password2): void
    {
        if($password1 != $password2) {
            $this->errors['password1'] = "Passwords do not match";
        }
        if(strlen($password1) > 25 || strlen($password1) < 5) {
            $this->errors['password2'] = "Password must be between 5 and 25 characters";
        }
        if(preg_match('/[^A-Za-z0-9]/', $password1)) {
            $this->errors['password3'] = "Password must only contain letters and numbers";
        }
    }
}
?>