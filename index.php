<?php 
include("includes/include_files.php");
?>
    <div class="pageHeader">
        You might be interested in...
    </div>
    <div class="gridViewContainer">
        <?php 
            $album_query = mysqli_query($connection, "SELECT * FROM albums ORDER BY RAND() LIMIT 10");

            while($row = mysqli_fetch_array($album_query)) {
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