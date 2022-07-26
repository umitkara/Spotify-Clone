<?php
class Playlist {
    private $connection;
    private $id;
    private $name;
    private $owner;

    public function __construct($connection, $id)
    {
        $this->connection = $connection;
        $this->id = $id;
        $query = mysqli_query($connection, "SELECT * FROM playlists WHERE id = '$id'");
        $row = mysqli_fetch_array($query);
        $this->name = $row['name'];
        $this->owner = $row['owner'];
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
        $u = new User($this->connection, (int)$this->owner);
        return $u->get_username();
    }

    public function get_songs()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM playlistsongs WHERE playlistID = $this->id");
        $songs = array();
        while($row = mysqli_fetch_assoc($query)) {
            array_push($songs, $row['songID']);
        }
        return $songs;
    }

    public function song_count()
    {
        $query = mysqli_query($this->connection, "SELECT * FROM playlistsongs WHERE playlistID = $this->id");
        return mysqli_num_rows($query);
    }
}
?>