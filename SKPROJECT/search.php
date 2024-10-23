<?php include 'header.php'?>
<?php include 'includes/dbh.inc.php'?>


<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Aktiviti</h2>
        </div>
    </div>
    


    

    <div class="activity-container">
        <?php
        if (isset($_POST['submit-search'])) {
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT a.nama_aktiviti, a.masa, a.idguru,a.idaktiviti, g.nama 
                    FROM aktiviti AS a
                    INNER JOIN guru AS g ON a.idguru = g.idguru
                    WHERE a.nama_aktiviti LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<a class='activity-card' href='activity_details.php?id=" . $row['idaktiviti'] . "'style='text-decoration:none'>";
                    echo "<h2>" . $row['nama_aktiviti'] . "</h2>";
                    echo "<p>Masa: " . $row['masa'] . "</p>";
                    echo "<p>Guru Bertugas: " . $row['nama'] . "</p>";
                    echo "</a>";
                    echo "<br>";
                }
            } else {
                echo "No matching results!";
            }
        }
        ?>
    </div>
</div>
