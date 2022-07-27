<?php
class User {
    private $connection;
    private $id;
    private $username;

    public function __construct($connection, $id)
    {
        $this->connection = $connection;
        if (is_int($id)) {
            $query = mysqli_query($connection, "SELECT * FROM users WHERE id = $id");
            $user = mysqli_fetch_assoc($query);
            $this->id = $user['id'];
            $this->username = $user['username'];
        } else {
            $query = mysqli_query($connection, "SELECT * FROM users WHERE username = '$id'");
            $user = mysqli_fetch_assoc($query);
            $this->id = $user['id'];
            $this->username = $user['username'];
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

    public function get_playlists()
    {
        $playlists = array();
        $query = mysqli_query($this->connection, "SELECT * FROM playlists WHERE owner = '$this->id'");
        while ($row = mysqli_fetch_array($query)) {
            $playlists[] = $row['id'];
        }
        return $playlists;
    }
}
?>