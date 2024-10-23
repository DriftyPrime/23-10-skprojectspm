<?php
include 'database_connection.php'; // Adjust this path as necessary

if (isset($_POST['search']) && isset($_POST['table-query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $table = $_POST['table-query'];

    if ($table == "peserta") {
        $sql = "SELECT nama FROM peserta WHERE nama LIKE '%$search%' LIMIT 10";
    } elseif ($table == "aktiviti") {
        $sql = "SELECT nama_aktiviti AS nama FROM aktiviti WHERE nama_aktiviti LIKE '%$search%' LIMIT 10";
    } elseif ($table == "guru") {
        $sql = "SELECT nama FROM guru WHERE nama LIKE '%$search%' LIMIT 10";
    } elseif ($table == "rumahsukan") {
        $sql = "SELECT nama_rumahsukan AS nama FROM rumahsukan WHERE nama_rumahsukan LIKE '%$search%' LIMIT 10";
    }

    $result = mysqli_query($conn, $sql);
    $output = "";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $output .= "<div class='dropdown-item'>" . htmlspecialchars($row['nama']) . "</div>";
        }
    } else {
        $output = "<div class='dropdown-item'>No results found</div>";
    }

    echo $output;
}
?>
