<?php include 'header.php'; ?>
<html>
<link rel="stylesheet" href="css/style.css">
<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Carian Peserta</h2>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <style>
        .custom-table {
            border-collapse: collapse;
            width: 100%;
            background-color: rgb(1, 33, 1);
        }
        
        .custom-table th, .custom-table td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
        }
        
        .custom-table th {
            background-color: #4CAF50;
            color: white;
        }
        
        .custom-table td a {
            color: white;
            text-decoration: none;
        }
    </style>
    
    <button class="return_button" onclick="goBack()">🔙</button>
    
    <form class="searchbar" method="post" id="search-form">
        <input type="text" id="search" name="search" placeholder="nama" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>" onkeyup="searchResults()">
        <input type="submit" value="Cari" style="width: 80px;">
        <select id="table-query" name="table-query" onchange="saveSelectedValue(); submitForm()">
            <option value="peserta">Peserta</option>
            <option value="aktiviti">Aktiviti</option>
            <option value="guru">Guru</option>
            <option value="rumahsukan">Rumah Sukan</option>
        </select>
    </form>

    <br>
    <button onclick="printTable()">Cetak</button>
    <div class="activity-container" id="activity-container">
        <!-- Initial data will be loaded here -->
        <?php 
            if (isset($_POST['search']) || isset($_POST['table-query'])) {
                $table = $_POST['table-query'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            
                // Query database based on search input and table selection
                if ($table == "peserta") {
                    $sql = "SELECT p.nama, p.idpeserta, p.nombor_telefon, r.nama_rumahsukan
                            FROM peserta AS p
                            INNER JOIN rumahsukan AS r ON p.idrumahsukan = r.idrumahsukan
                            WHERE p.nama LIKE '%$search%'";
                } elseif ($table == "aktiviti") {
                    $sql = "SELECT a.nama_aktiviti, a.masa, a.idaktiviti, guru.nama
                            FROM aktiviti AS a
                            INNER JOIN guru ON a.idguru = guru.idguru
                            WHERE a.nama_aktiviti LIKE '%$search%'
                            OR a.masa LIKE '%$search%'
                            OR guru.nama LIKE '%$search%'";
                } elseif ($table == "guru") {
                    $sql = "SELECT guru.nama, aktiviti.nama_aktiviti, guru.nombor_telefon
                            FROM guru 
                            INNER JOIN aktiviti ON guru.idguru = aktiviti.idguru 
                            WHERE guru.nama LIKE '%$search%'";
                } elseif ($table == "rumahsukan") {
                    $sql = "SELECT r.nama_rumahsukan, r.idrumahsukan 
                        ––    FROM rumahsukan AS r
                            WHERE r.nama_rumahsukan LIKE '%$search%'";
                }
            
                $result = mysqli_query($conn, $sql);
                $queryResult = mysqli_num_rows($result);
            
                // Print table with search results
                if ($queryResult > 0) {
                    echo "<table class='custom-table'>";
                    echo "<tr>";
                    if ($table == "peserta") {
                        echo "<th>No</th><th>Nama</th><th>Email</th><th>Nombor Telefon</th><th>Rumah Sukan</th>";
                    } elseif ($table == "aktiviti") {
                        echo "<th>No</th><th>Nama Aktiviti</th><th>Masa</th><th>Guru Bertugas</th>";
                    } elseif ($table == "guru") {
                        echo "<th>No</th><th>Nama Guru</th><th>Aktiviti</th><th>Nombor Telefon</th>";
                    } elseif ($table == "rumahsukan") {
                        echo "<th>No</th><th>Nama Rumah Sukan</th>";
                    }
                    echo "</tr>";
            
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                         
                        if ($table == "peserta") {
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['idpeserta'] . "</td>";
                            echo "<td>" . $row['nombor_telefon'] . "</td>";
                            echo "<td>" . $row['nama_rumahsukan'] . "</td>";
                        } elseif ($table == "aktiviti") {
                            echo "<td><a href='activity_details.php?id=" . $row['idaktiviti'] . "'>" . $row['nama_aktiviti'] . "</a></td>";
                            echo "<td>" . $row['masa'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                        } elseif ($table == "guru") {
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['nama_aktiviti'] . "</td>";
                            echo "<td>" . $row['nombor_telefon'] . "</td>";
                        } elseif ($table == "rumahsukan") {
                            echo "<td>" . $row['nama_rumahsukan'] . "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No matching results!";
                }
            }
        ?>
    </div>
    
    <script>
        function printTable() {
            var printContents = document.getElementById('activity-container').innerHTML;
            var originalContents = document.body.innerHTML;
            
            // Create a new window object
            var printWindow = window.open('', '_blank');
            
            // Create a new HTML document in the new window
            printWindow.document.write(`
                <!DOCTYPE html>
                <html>
                <head>
                    <title>aktiviti_disertai</title>
                    <style>
                    table { width: 100%; border: 1px solid black; border-collapse: collapse; margin: 0 auto; }
                    th, td { border: 1px solid black; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; }
                    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
                    @page { size: auto; margin: 15mm; }
                    body { margin: 15mm; }
                    </style>
                </head>
                <body>
                    ${printContents}
                </body>
                </html>
            `);
            
            // Print the new window
            printWindow.print();
            
            // Close the new window
            printWindow.close();
            
            // Restore the original contents of the original window
            document.body.innerHTML = originalContents;
        }
        
        function submitForm() {
            // Clear the search input
            document.getElementById("search").value = "";
            // Submit the form
            document.getElementById("search-form").submit();
        }

        
        function saveSelectedValue() {
            var selectedValue = document.getElementById("table-query").value;
            localStorage.setItem("selectedTableQuery", selectedValue);
        }

        // Load selected value from local storage on page load
        window.onload = function() {
            var savedValue = localStorage.getItem("selectedTableQuery");
            if (savedValue) {
                document.getElementById("table-query").value = savedValue;
            }
        };
    </script>
</div> 
</body>
</html>
