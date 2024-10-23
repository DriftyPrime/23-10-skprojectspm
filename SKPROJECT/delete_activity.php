<?php include 'header.php'?>
<?php include 'includes/dbh.inc.php'?>


<html>
    <body>
                <script>
                function goBack() {
                    window.history.back();
                }
                </script>
            
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Aktiviti</h2>
                        <button class="return_button" onclick="goBack()">🔙</button>
                    </div>
                </div>
            
            
                

                <div class="activity-container">
                    <?php
                        $sql = "SELECT aktiviti.idaktiviti, aktiviti.nama_aktiviti, aktiviti.masa, aktiviti.idguru  ,guru.nama FROM aktiviti INNER JOIN guru ON aktiviti.idguru = guru.idguru";
                        $result = mysqli_query($conn, $sql);
                        $queryResults = mysqli_num_rows($result);

                        if($queryResults > 0)
                        {
                            while($row = mysqli_fetch_assoc($result))
                            {
                                echo "<a class='activity-card' href='activity_details.php?id=" . $row['idaktiviti'] . "' style='text-decoration:none'>";
                                echo "<h2>" . $row['nama_aktiviti'] . "</h2>";
                                echo "<p> Masa: " . $row['masa'] . "</p>";
                                echo "<p> Guru Bertugas: " . $row['nama'] . "</p>";
                                echo "<form action='includes/delete_activity.inc.php' method='POST'>";
                                echo "<input type='hidden' name='id' value='" . $row['idaktiviti'] . "'>";
                                echo "<input type='submit' name='delete' value='Delete' style='background-color:red; color:white;'>";
                                echo "</form>";
                                echo "</a>";
                                echo "<br>";
                            }
                        }
                    ?>
                </div>   
            </div>  
            
            
    </body>
</html>