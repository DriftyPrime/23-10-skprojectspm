<?php include_once 'header.php'; ?>
<?php include_once 'includes/dbh.inc.php'; ?>

<html>
    <body>  
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Aktiviti</h2>
                </div>
            </div>

            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
            
            <button class="return_button" onclick="goBack()">🔙</button>

            <div class="adminbutton">
                <?php
                    if (isset($_SESSION["id"])) {
                        $userType = checkAdminOrUser($conn, $_SESSION["id"]);
                        if ($userType === 'admin') {
                            echo '<button><a href="add_activity.php" style="text-decoration:none">Add Activity</a></button>';
                            echo '<button><a href="delete_activity.php" style="text-decoration:none; color:black">Delete Activity</a></button>';
                        }
                    }
                ?>
            </div>

            <form class="searchbar" onsubmit="return false;">
                <input type="text" id="search" name="search" placeholder="aktiviti" onkeyup="searchActivities()">
            </form>

            <div class="activity-container" id="activity-container">
                <?php
                    // Load all activities initially
                    $sql = "SELECT aktiviti.idaktiviti, aktiviti.nama_aktiviti, aktiviti.masa, aktiviti.idguru, guru.nama 
                            FROM aktiviti 
                            INNER JOIN guru ON aktiviti.idguru = guru.idguru";
                    $result = mysqli_query($conn, $sql);
                    $queryResults = mysqli_num_rows($result);

                    if($queryResults > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<a class='activity-card' href='activity_details.php?id=" . $row['idaktiviti'] . "' style='text-decoration:none'>";
                            echo "<h2>" . $row['nama_aktiviti'] . "</h2>";
                            echo "<p> Masa: " . $row['masa'] . "</p>";
                            echo "<p> Guru Bertugas: " . $row['nama'] . "</p>";
                            echo "</a>";
                            echo "<br>";
                        }
                    } else {
                        echo "<p>No activities found</p>";
                    }
                ?>
            </div>

            <script>
                function searchActivities() {
                    const searchQuery = document.getElementById('search').value;
                    const xhr = new XMLHttpRequest();

                    xhr.open("POST", "search_activities.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById('activity-container').innerHTML = xhr.responseText;
                        }
                    };

                    xhr.send("search=" + encodeURIComponent(searchQuery));
                }
            </script>
        </div>  
    </body>
</html>
