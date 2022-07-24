<?php
    class Album {
        private $connection;
        private $id;
        private $title;
        private $artist_id;
        private $genre;
        private $artwork_path;

        public function __construct($connection, $id) {
            $this->connection = $connection;
            $this->id = $id;
            $query = mysqli_query($connection, "SELECT * FROM albums WHERE id = $id");
            $album = mysqli_fetch_assoc($query);
            $this->title = $album['title'];
            $this->artist_id = $album['artist'];
            $this->genre = $album['genre'];
            $this->artwork_path = $album['albumArt'];
        }

        public function get_title()
        {
            return $this->title;
        }

        public function get_artist()
        {
            return new Artist($this->connection, $this->artist_id);
        }

        public function get_genre()
        {
            return $this->genre;
        }

        public function get_artwork_path()
        {
            return $this->artwork_path;
        }
    }
?>