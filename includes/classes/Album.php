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

        public function song_count()
        {
            $query = mysqli_query($this->connection, "SELECT COUNT(*) AS count FROM songs WHERE album = $this->id");
            $row = mysqli_fetch_assoc($query);
            return $row['count'];
        }

        public function get_songs()
        {
            $query = mysqli_query($this->connection, "SELECT * FROM songs WHERE album = $this->id ORDER BY albumOrder ASC");
            $songs = array();
            while($row = mysqli_fetch_assoc($query)) {
                array_push($songs, $row['id']);
            }
            return $songs;
        }

        public function get_artist_id()
        {
            return $this->artist_id;
        }
    }
?>