<?php include 'header.php'?>
<?php include 'includes/dbh.inc.php'?>



<html>
   
    <style> 
        .activity-container form label
        {
            size: 200px;
        }
    </style>
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
                <form action="includes/add_activity.inc.php" method="post">
                    <label>Activity:</label>
                    <input type="text" name="activity" placeholder="nama aktiviti" required><br><br>
                    <label>Time:</label>
                    <input type="date"  name="date" required><br>
                    <input type="hidden" name="idguru" value="<?php echo $_SESSION["id"]?>">
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
            <div>
                <?php
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"] == "none")
                        {
                            echo "<p>Successfully added activity</p>";
                        }
                    }
                ?>
            </div>
                
            
            </div>   
        </div>  
        
        
    </body>
</html>


