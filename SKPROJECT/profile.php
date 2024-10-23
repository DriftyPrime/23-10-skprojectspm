<?php include 'header.php'?>
<?php include 'includes/dbh.inc.php'?>


<html>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <body>
        
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Profil</h2>
                </div>
            </div>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
            
            <button class="return_button" onclick="goBack()">⬅️</button>
            <style>
                .activity-container {
                    overflow-y: auto;
                    text-align: left;
                }

                
            </style>


            <div class="activity-container">
               <?php
                    $gmail=$_SESSION["id"];
                    // Assuming you have an open database connection ($conn)
                    
                    // Retrieve user information from the database
                    $stmt = mysqli_prepare($conn, "SELECT * FROM peserta INNER JOIN rumahsukan ON peserta.idrumahsukan = rumahsukan.idrumahsukan WHERE idpeserta = ?");
                    mysqli_stmt_bind_param($stmt, "s", $gmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    // Check if there are any records
                    if (mysqli_num_rows($result) > 0) {
                        // Display the table
                        $row = mysqli_fetch_assoc($result);
                        
                        echo "<p>Nama:<a href='edit_profile.php?function=editname' style='color:white;'> " . htmlspecialchars($row['nama']) . "</a><i class=\"material-symbols-outlined\">edit</i></p>";
                        echo"<p> Email: " . $gmail . "</p>";
                        echo"<p> Rumah Sukan: " . $row['nama_rumahsukan'] . "</p>";
                        if($row['nombor_telefon'] == null){
                            
                            echo"<p>Nombor Telefon: <a href='edit_profile.php?function=editpn' style='color:white;text-decoration:none;'><span style='color:grey;'>Tidak diketahui </span><i class=\"fas fa-plus\"></i></a></p>";
                        }else{
                            echo"<p class='nombor_telefon'> Nombor Telefon: <a href='edit_profile.php?function=editpn' style='color:white;text-decoration:none;'><span style='color:grey;'> </span><i class=\"fas fa-plus\"></i></a>" . $row['nombor_telefon'] . "</p>";
                        }
                       
                    } else {
                        if(checkAdminOrUser($conn, $gmail) == 'admin'){
                            
                        }else{
                            echo "No records found.";
                        }
                        
                    }
                    
                    // Close the statement
                    mysqli_stmt_close($stmt);

                   

                ?>

                
                <?php 
                if(isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if ($error == 'pntukar') {
                        echo "<p class='error' style='color:red;'>Nombor telefon berjaya ditukar</p>";
                    } elseif ($error == 'namatukar') {
                        echo "<p class='error' style='color:red;'>Nama berjaya ditukar</p>";
                    }
                }
                ?>
            <script>
                function printTable() {
                    var printContents = document.getElementById('profile-table').outerHTML;
                    var printWindow = window.open('', '', 'height=500,width=800');
                    printWindow.document.write('<!DOCTYPE html>');
                    printWindow.document.write('<html><head><title>aktiviti_disertai</title>');
                    printWindow.document.write('<style>');
                    printWindow.document.write('table { width: 100%; border: 1px solid black; border-collapse: collapse; margin: 0 auto; }');
                    printWindow.document.write('th, td { border: 1px solid black; padding: 8px; text-align: left; }');
                    printWindow.document.write('th { background-color: #f2f2f2; }');
                    printWindow.document.write('body { font-family: Arial, sans-serif; margin: 0; padding: 0; }');
                    printWindow.document.write('@page { size: auto; margin: 15mm; }');
                    printWindow.document.write('body { margin: 15mm; }');
                    printWindow.document.write('</style>');
                    printWindow.document.write('<h2 ">Nama: ' + '<?php echo $row["nama"] ?>' + '</h2>');
                    printWindow.document.write('<h3 style="text-align:left;">Email: ' + '<?php echo $gmail ?>' + '</h3>');
                    printWindow.document.write('<h3 style="text-align:left;">Rumah Sukan: ' + '<?php echo $row["nama_rumahsukan"] ?>' + '</h3>');
                    printWindow.document.write('<h3 style="text-align:left;">Nombor Telefon: ' + '<?php echo $row["nombor_telefon"] ?>' + '</h3>');
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
                    if(checkAdminOrUser($conn, $gmail) == 'user'){
                        echo "<button><a href=\"profile_download_table.php\" style=\"color:black;text-decoration:none\">Download Table</a></button>";
                        echo "<button onclick=\"printTable()\">Print Table</button>";

                        
                    }
                ?>
               
                <?php
                    require_once 'includes/dbh.inc.php';
                    
                    // Retrieve the user's ID from the session or somewhere else
                    $userId = $_SESSION['id'];
                    
                    // Retrieve the activities joined by the user
                    $sql = "SELECT * FROM penyertaan JOIN aktiviti ON penyertaan.idaktiviti = aktiviti.idaktiviti WHERE idpeserta = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "s", $userId);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    if(checkAdminOrUser($conn, $userId) == 'admin'){
                      
                        echo "<style>";
                        echo "";
                        echo "</style>";
                        echo "<h2>Create a new admin account</h2>";
                        echo "<form action='includes/signup.inc.php' method='POST' style='display: inline-block;'>";
                        echo "<input type='text' name='name_admin' placeholder='Name' required><br>";
                        echo "<input type='text' name='email_admin' placeholder='Email' required><br>";
                        echo "<input type='password' name='pwd_admin' placeholder='Password' required><br>";
                        echo "<input type='password' name='pwdrepeat_admin' placeholder='Repeat Password' required><br>";
                        echo "<button type='submit' name='submit_admin'>Sign Up</button>";
                        echo "</form>";
                        

                    }else if(checkAdminOrUser($conn, $userId) == 'user'){
                       // Display the activities in a table
                        echo "<table id='profile-table' class='table-profil'>";
                        echo "<tr><th>No</th><th>Nama</th><th>Masa</th><th>Status Kehadiran</th></tr>";
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $i++ . "</td>";
                            echo "<td>" . $row['nama_aktiviti'] . "</td>";
                            echo "<td>" . $row['masa'] . "</td>";
                            if($row['status_kehadiran'] == null){
                                echo"<td>Tidak Hadir</td>";
                            }else{
                                echo "<td>" . $row['status_kehadiran'] . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>"; 
                    }
                    
                    
                    mysqli_stmt_close($stmt);
                ?>
            </div>   
        </div>  
        
        
    </body>
</html>
