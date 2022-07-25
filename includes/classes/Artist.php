<?php
    class Artist {
        private $connection;
        private $id;
        private $name;

        public function __construct($connection, $id) {
            $this->connection = $connection;
            $this->id = $id;
        }

        public function get_name() {
            $artist_query = mysqli_query($this->connection, "SELECT * FROM artists WHERE id = $this->id");
            $artist = mysqli_fetch_assoc($artist_query);
            return $artist['name'];
        }

        public function get_number_of_albums() {
            $album_query = mysqli_query($this->connection, "SELECT * FROM albums WHERE artist = $this->id");
            return mysqli_num_rows($album_query);
        }

        public function get_number_of_songs() {
            $song_query = mysqli_query($this->connection, "SELECT * FROM songs WHERE artist = $this->id");
            return mysqli_num_rows($song_query);
        }
    }
?>