<?php
class Playlist {
    private $connection;
    private $id;
    private $name;
    private $owner;

    public function __construct($connection, $data)
    {
        $this->connection = $connection;
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->owner = $data['owner'];
    }

    public function get_id()
    {
        return $this->id;
    }

    public function get_name()
    {
        return $this->name;
    }

    public function get_owner_id()
    {
        return $this->owner;
    }

    public function get_owner()
    {
        $u = new User($this->connection, $this->owner);
        return $u->get_username();
    }

    public function get_songs()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM playlist_songs WHERE playlist_id = $this->id");
        $songs = array();
        while($row = mysqli_fetch_assoc($query)) {
            array_push($songs, $row['song_id']);
        }
        return $songs;
    }
}
?>