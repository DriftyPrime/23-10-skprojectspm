<?php 
include_once 'includes/dbh.inc.php';
if (isset($_POST['search']) || isset($_POST['table-query'])) {
    $table = $_POST['table-query'];
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    if ($table == "peserta") {
        $sql = "SELECT p.nama, p.idpeserta, p.nombor_telefon, r.nama_rumahsukan
                FROM peserta AS p
                INNER JOIN rumahsukan AS r ON p.idrumahsukan = r.idrumahsukan
                WHERE p.nama LIKE '%$search%'";
    } elseif ($table == "aktiviti") {
        $sql = "SELECT a.nama_aktiviti, a.masa, a.idaktiviti, g.nama
                FROM aktiviti AS a
                INNER JOIN guru AS g ON a.idguru = g.idguru
                WHERE a.nama_aktiviti LIKE '%$search%'
                OR a.masa LIKE '%$search%'
                OR g.nama LIKE '%$search%'";
    } elseif ($table == "guru") {
        $sql = "SELECT guru.nama, aktiviti.nama_aktiviti, guru.nombor_telefon
                FROM guru 
                INNER JOIN aktiviti ON guru.idguru = aktiviti.idguru 
                WHERE guru.nama LIKE '%$search%'";
    } elseif ($table == "rumahsukan") {
        $sql = "SELECT r.nama_rumahsukan, r.idrumahsukan 
                FROM rumahsukan AS r
                WHERE r.nama_rumahsukan LIKE '%$search%'";
    }

    $result = mysqli_query($conn, $sql);
    $queryResult = mysqli_num_rows($result);

    if ($queryResult > 0 && $table == "peserta") {
        echo "<table class='custom-table'>";
        echo "<tr><th>No</th><th>Nama</th><th>ID</th><th>Nombor Telefon</th><th>Rumah Sukan</th><th>Aktiviti</th></tr>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $i++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['idpeserta'] . "</td>";
            echo "<td>" . $row['nombor_telefon'] . "</td>";
            echo "<td>" . $row['nama_rumahsukan'] . "</td>";
            echo "<td>";

            // Get activities for each participant
            $activity_sql = "SELECT a.nama_aktiviti 
                             FROM aktiviti AS a 
                             INNER JOIN penyertaan AS pe ON a.idaktiviti = pe.idaktiviti 
                             WHERE pe.idpeserta = ?";
            $activiti_stmt = mysqli_prepare($conn, $activity_sql);
            mysqli_stmt_bind_param($activiti_stmt, 's', $row['idpeserta']);
            mysqli_stmt_execute($activiti_stmt);
            $activiti_result = mysqli_stmt_get_result($activiti_stmt);
            while ($activiti_row = mysqli_fetch_assoc($activiti_result)) {
                echo $activiti_row['nama_aktiviti'] . "<br>";
            }

            echo "</td></tr>";
        }
        echo "</table>";
    } elseif ($queryResult > 0 && $table == "aktiviti") {
        echo "<table class='custom-table'>";
        echo "<tr><th>No</th><th>Nama Aktiviti</th><th>Guru Bertugas</th><th>Masa</th></tr>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $i++ . "</td>";
            echo "<td><a href='activity_details.php?id=" . $row['idaktiviti'] . "'>" . $row['nama_aktiviti'] . "</a></td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['masa'] . "</td>";
        }
        echo "</table>";
    } elseif ($queryResult > 0 && $table == "guru") {
        echo "<table class='custom-table'>";
        echo "<tr><th>No</th><th>Nama Guru</th><th>Aktiviti</th><th>Nombor Telefon</th></tr>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $i++ . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['nama_aktiviti'] . "</td>";
            echo "<td>" . $row['nombor_telefon'] . "</td>";
        }
        echo "</table>";
    } elseif ($queryResult > 0 && $table == "rumahsukan") {
        echo "<table class='custom-table'>";
        echo "<tr><th>No</th><th>Nama Rumah Sukan</th><th>Jumlah Ahli</th></tr>";

        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $i++ . "</td>";
            echo "<td>" . $row['nama_rumahsukan'] . "</td>";

            // Count members in each sports house
            $countsql = "SELECT COUNT(*) FROM peserta WHERE idrumahsukan = ?";
            $countstmt = mysqli_prepare($conn, $countsql);
            mysqli_stmt_bind_param($countstmt, 's', $row['idrumahsukan']);
            mysqli_stmt_execute($countstmt);
            $countresult = mysqli_stmt_get_result($countstmt);
            $countrow = mysqli_fetch_assoc($countresult);

            echo "<td>" . $countrow['COUNT(*)'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No matching results!";
    }
} else {
    echo "Enter a query.";
}

