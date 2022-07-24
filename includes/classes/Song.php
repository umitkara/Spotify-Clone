<?php
    class Song {
        private $connection;
        private $id;
        private $data;
        private $title;
        private $artist_id;
        private $album_id;
        private $genre;
        private $duration;
        private $path;

        public function __construct($connection, $id)
        {
            $this->connection = $connection;
            $this->id = $id;
            $query = mysqli_query($this->connection, "SELECT * FROM songs WHERE id = '$this->id'");
            $this->data = mysqli_fetch_array($query);
            $this->title = $this->data['title'];
            $this->artist_id = $this->data['artist'];
            $this->album_id = $this->data['album'];
            $this->genre = $this->data['genre'];
            $this->duration = $this->data['duration'];
            $this->path = $this->data['path'];
        }

        public function get_title() {
            return $this->title;
        }

        public function get_artist() {
            return new Artist($this->connection, $this->artist_id);
        }

        public function get_album() {
            return new Album($this->connection, $this->album_id);
        }

        public function get_genre() {
            return $this->genre;
        }

        public function get_duration() {
            return $this->duration;
        }

        public function get_path() {
            return $this->path;
        }
    }
?>