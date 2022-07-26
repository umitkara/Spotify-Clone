<?php 
include("includes/include_files.php");
if(isset($_GET['q'])) {
    $search_q = urldecode($_GET['q']);
} else {
    $search_q = "";
}
?>

<div class="searchContainer">
    <h4>
        Search for an artist, album, or song...
    </h4>
    <input type="text" id="search_q" value="<?php echo $search_q; ?>" placeholder="Start Searching..." class="searchInput">
</div>

<script>
    $(document).ready(function(){
        $(".searchInput").focus();
        var search = $(".searchInput").val();
        $(".searchInput").val('');
        $(".searchInput").val(search);
    })
    $(".searchInput").focus();
    $(
        function() {
            $(".searchInput").on("keyup", function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    let search_q = $("#search_q").val();
                    open_page("search.php?q=" + search_q);
                }, 1000);
            });
        }
    )
</script>

<?php 
if($search_q == "") {
    exit();
}
?>

<div class="trackListContainer">
    <h2>
        Songs
    </h2>
    <ul class="trackList">
        <?php
            $song_query = mysqli_query($connection, "SELECT id FROM songs WHERE title LIKE '%$search_q%' LIMIT 10");

            if(mysqli_num_rows($song_query) == 0) {
                echo "<span>No songs found</span>";
            }

            $songs_arr = array();
            while($row = mysqli_fetch_array($song_query)) {
                array_push($songs_arr, $row['id']);
            }

            $i = 1;
            foreach($songs_arr as $song_id) {
                $song = new Song($connection, $song_id);
                echo "<li class='trackListRow'>
                        <div class='trackCount'>
                            <span role='link' tabindex='0' class='fa-regular fa-play' onclick='setTrack(\"" . $song->get_id() . "\", temp_playlist, true)'></span>
                            <span class='trackNumber'>$i</span>
                        </div>
                        <div class='trackInfo' role='link' tabindex='0' onclick='setTrack(\"" . $song->get_id() . "\", temp_playlist, true)'>
                            <span class='trackName'>" . $song->get_title() . "</span>
                            <span class='artistName'>" . $song->get_artist()->get_name() . "</span>
                        </div>
                        <div class='trackDuration'>
                            <span class='duration'>" . $song->get_duration() . "</span>
                        </div>
                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='" . $song->get_id() . "'>
                            <span role='link' tabindex='0' class='fa-regular fa-ellipsis-v' onclick='showOptionsMenu(this)'></i>
                        </div>
                    </li>";
                $i++;
            }
        ?>
    </ul>
</div>

<div class="artistContainer">
    <h2>
        Artists
    </h2>
    <?php
        $artist_query = mysqli_query($connection, "SELECT id FROM artists WHERE name LIKE '%$search_q%' LIMIT 10");
        if(mysqli_num_rows($artist_query) == 0) {
            echo "<span>No artists found</span>";
        }
        $artist_arr = array();
        while($row = mysqli_fetch_array($artist_query)) {
            array_push($artist_arr, $row['id']);
        }
        foreach($artist_arr as $artist_id) {
            $artist = new Artist($connection, $artist_id);
            echo "<div class='searchResultRow'>
                    <div class='searchArtistName'>
                        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artist_id . "\")'>" . $artist->get_name() . "</span>
                    </div>
                </div>";
        }

    ?>
</div>

<div class="gridViewContainer">
    <h2>
        Albums
    </h2>
    <?php
    $album_query = mysqli_query($connection, "SELECT * FROM albums WHERE title LIKE '%$search_q%' LIMIT 10");

    if(mysqli_num_rows($album_query) == 0) {
        echo "<span>No albums found</span>";
    }

    while ($row = mysqli_fetch_array($album_query)) {
        echo "<div class='gridViewItem'>
                        <span role='link' tabindex='0' onclick='open_page(\"album.php?id=" . $row['id'] . "\")'>
                            <img src='" . $row['albumArt'] . "'>
                            <div class='gridViewInfo'>"
            . $row['title'] .
            "</div>
                        </span>
                    </div>";
    }

    ?>
</div>