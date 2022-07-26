<?php 
include("includes/include_files.php");
?>

<div class="playlistContainer">
    <div class="gridViewContainer">
        <h2>
            Playlists
        </h2>
        <div class="buttonContainer">
            <button class="button green" onclick="create_playlist()">
                Create Playlist
            </button>
        </div>
        <?php
            $username = $_SESSION['user_id'];
            $user = new User($connection, $username);
            $user_id = $user->get_id();
            $playlist_query = mysqli_query($connection, "SELECT * FROM playlists WHERE owner = '$user_id'");
            if(mysqli_num_rows($playlist_query) == 0) {
                echo "<span>No playlists found</span>";
            }
            while($row = mysqli_fetch_array($playlist_query)) {
                $playlist_id = $row['id'];
                $playlist_name = $row['name'];
                echo "<div class='gridViewItem'>
                        <div class='playlistItem'>
                            <div class='playlistThumb' role='link' tab-index='0' onclick='open_page(\"playlist.php?id=$playlist_id\")'>
                                <img src='assets\images\album_default.jpg' draggable='false'>
                            </div>
                            <div class='playlistName' role='link' tab-index='0' onclick='open_page(\"playlist.php?id=$playlist_id\")'>
                                $playlist_name
                            </div>
                            <div class='playlistItemControls'>
                                <input type='hidden' class='playlistId' value='$playlist_id'>
                                <button class='button buttonSmall green' onclick='showPlaylistSongs($playlist_id)'>
                                    <i class='fa-regular fa-chevron-right'></i>
                                </button>
                                <button class='button buttonSmall red' onclick='showPlaylistOptions($playlist_id)'>
                                    <i class='fa-regular fa-xmark'></i>
                                </button>
                            </div>
                        </div>
                    </div>";
            }
        ?>
    </div>
</div>