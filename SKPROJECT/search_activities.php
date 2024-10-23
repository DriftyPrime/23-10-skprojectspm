<?php 
include_once 'includes/dbh.inc.php';

if (isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    
    $sql = "SELECT aktiviti.idaktiviti, aktiviti.nama_aktiviti, aktiviti.masa, aktiviti.idguru, guru.nama 
            FROM aktiviti 
            INNER JOIN guru ON aktiviti.idguru = guru.idguru 
            WHERE aktiviti.nama_aktiviti LIKE '%$search%' OR guru.nama LIKE '%$search%'";

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
}
?>
