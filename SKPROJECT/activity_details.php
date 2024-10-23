<?php include 'header.php'?>
<?php include 'includes/dbh.inc.php'?>

<?php include 'includes/check_user_rumahsukan.php'?>
<html>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <body>
        
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Aktiviti</h2>
                    <button class="return_button" onclick="goBack()">🔙</button>
                </div>
                
            </div>

            
            
            

            <div class="activity-container-detail" style="overflow-y: auto;">
                <?php
                    if(isset($_GET["id"]))
                    {
                        $id = $_GET["id"];
                        $sql = "SELECT * FROM aktiviti INNER JOIN guru ON aktiviti.idguru = guru.idguru WHERE idaktiviti = $id";
                        $result = mysqli_query($conn, $sql);
                        $queryResults = mysqli_num_rows($result);
                        
                        if($queryResults > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<div class='activity-card-details' >";
                                echo "<h2>" . $row['nama_aktiviti'] . "</h2>";
                                echo "<p> Masa: " . $row['masa'] . "</p>";
                                echo "<p> Guru Bertugas: " . $row['nama'] . "</p>";
                                echo "</div>";
                                echo "<br>";
                            }
                        }
                    }  
                    $sql2="SELECT * FROM peserta WHERE idpeserta = '" . $_SESSION['id'] . "'";
                    $result2 = mysqli_query($conn, $sql2);
                    $queryResults2 = mysqli_num_rows($result2);
                    if($queryResults2 > 0)
                    {
                        while($row = mysqli_fetch_assoc($result2))
                        {
                            $name = $row['nama'];
                        }
                    }else{
                        $name = "no name";
                    }
                ?>


                <form action="joinactivity.php" method="post">
                    <input type="hidden" name="idpeserta" placeholder="   idpeserta" value="<?php echo $_SESSION['id']; ?>" required>
                    <input type="hidden" name="idaktiviti" value="<?php echo $id;?>">
                    <input type="hidden" name="nama" placeholder="  nama" value="<?php echo $name; ?>" required>
                    <button type="submit" name="submit">Sertai</button>
                    
                </form>
                <?php  
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"] == "alreadyjoined")
                        {
                            echo "<p>You have already joined this activity</p>";
                        }

                        if($_GET["error"] == "none")
                        {
                            echo "<p style='color:lightgreen;'>You have successfully joined this activity</p>";
                        }

                        if($_GET["error"] == "usernotfound")
                        {
                            echo "<p style='color:red;'>User incorrect or name does not match with idpeserta</p>";
                        }
                        if($_GET["error"] == "sqlfailed")
                        {
                            echo "<p>Something went wrong, try again</p>";
                        }


                    }

                ?>
               <script>
                    function printTable() {
                    var printContents = document.getElementById('printTable').outerHTML;
                    var printWindow = window.open('', '', 'height=500,width=800');
                    printWindow.document.write('<!DOCTYPE html>');
                    printWindow.document.write('<html><head><title>Print Table</title>');
                    printWindow.document.write('<style>');
                    printWindow.document.write('table { width: 100%; border: 1px solid black; border-collapse: collapse; margin: 0 auto; }');
                    printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
                    printWindow.document.write('th { background-color: #f2f2f2; }');
                    printWindow.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 0; }');
                    printWindow.document.write('@page { size: auto; margin: 15mm; }');
                    printWindow.document.write('body { margin: 15mm; }');
                    printWindow.document.write('</style>');
                    printWindow.document.write('</head><body>');
                    printContents = printContents.replace(/<a[^>]*>/g, '');
                    printContents = printContents.replace(/<\/a>/g, '');
                    printWindow.document.write(printContents);
                    printWindow.document.write('</body></html>');
                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
            }
               </script>
                
                <?php
                    
                    if (isset($_SESSION["id"])) {
                        $userType = checkAdminOrUser($conn, $_SESSION["id"]);
                        if ($userType === 'admin') 
                        {
                            // Assuming you have an open database connection ($conn)
                            
                            // Retrieve the idaktiviti value from the URL parameter
                            $idaktiviti = $_GET["id"];
                            
                            // Retrieve data from the penyertaan table based on the idaktiviti value
                            $sql = "SELECT * FROM penyertaan CROSS JOIN peserta ON penyertaan.idpeserta = peserta.idpeserta CROSS JOIN rumahsukan ON peserta.idrumahsukan = rumahsukan.idrumahsukan CROSS JOIN aktiviti ON penyertaan.idaktiviti = aktiviti.idaktiviti WHERE penyertaan.idaktiviti = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, "i", $idaktiviti);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            

                            // Check if there are any records
                            if (mysqli_num_rows($result) > 0) {
                                $row=mysqli_fetch_assoc($result);
                                $activityname = $row['nama_aktiviti'];
                                echo "<button><a href=\"download_table.php?id=" . $_GET["id"] . "\" style=\"color:black;text-decoration:none\">Download Table</a></button>";
                                echo "<button onclick=\"printTable()\" style=\"margin: 10px;\">Print</button>";
                                // Display the table
                                echo "<table id='printTable' class='table-aktiviti-details'>";
                                echo "<tr><th colspan='5'>Aktiviti: " . $activityname . "</th></tr>";
                                echo "<tr><th>No</th><th>Nama</th><th>Rumah Sukan</th><th>Kehadiran</th><th>Update Kehadiran</th></tr>"; // Add more columns as needed
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $i++ . "</td>";
                                    echo "<td>" . $row['nama'] . "</td>";
                                    echo "<td>" . $row['nama_rumahsukan'] . "</td>";
                                    echo"<td>" . ($row['status_kehadiran'] === "Tidak Hadir" ? "Tidak Hadir" : "Hadir") . "</td>";
                                    echo "<td align='center'>
                                            <a href='change_kehadiran.php?id=". htmlspecialchars(($row['idaktiviti'])) . "&status=" . $row['status_kehadiran'] . "&idpeserta=" . htmlspecialchars(urlencode($row['idpeserta'])) . "' style='color:white;'>Update Kehadiran</a> |
                                            <a href='change_kehadiran.php?id=".htmlspecialchars(urlencode($row['idaktiviti'])) . "&status=delete" . "&idpeserta=" . htmlspecialchars(urlencode($row['idpeserta'])) ." 'style='color:white;'>Delete</a>
                                          </td>";  
                                    echo "</tr>";
                                    
                                }
                                echo "</table>";
                            } else {
                                echo "No records found.";
                            }
                            
                            // Close the database connection and the statement
                            mysqli_stmt_close($stmt);
                            mysqli_close($conn);
                        }
                    }
                ?>
           

                
                    

            </div>
        </div>            
    </body>
</html>



    