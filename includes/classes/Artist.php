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
    }
?>