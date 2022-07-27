<?php
class User {
    private $connection;
    private $id;
    private $username;
    private $firstname;
    private $lastname;
    private $profile_photo;
    private $email;

    public function __construct($connection, $id)
    {
        $this->connection = $connection;
        if (is_int($id)) {
            $query = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
            $user = mysqli_fetch_assoc($query);
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $this->profile_photo = $user['profilePhoto'];
            $this->email = $user['email'];
        } else {
            $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$id'");
            $user = mysqli_fetch_assoc($query);
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->firstname = $user['firstname'];
            $this->lastname = $user['lastname'];
            $this->profile_photo = $user['profilePhoto'];
            $this->email = $user['email'];
        }
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function get_fullname()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function get_first_name()
    {
        return $this->firstname;
    }

    public function get_last_name()
    {
        return $this->lastname;
    }

    public function get_profile_photo()
    {
        return $this->profile_photo;
    }

    public function get_playlists()
    {
        $playlists = array();
        $query = mysqli_query($this->connection, "SELECT * FROM playlists WHERE owner = '$this->id'");
        while ($row = mysqli_fetch_array($query)) {
            $playlists[] = $row['id'];
        }
        return $playlists;
    }

    public function get_email()
    {
        return $this->email;
    }
}
?>