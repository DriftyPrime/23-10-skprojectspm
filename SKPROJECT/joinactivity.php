<?php
    
    require_once 'includes/dbh.inc.php';
    if(isset($_POST["submit"]))
    {   
        $idactivity = $_POST["idaktiviti"];
        $name = $_POST["nama"];
        $id = $_POST["idpeserta"];
        
        // Check if the user has already joined the activity
        $sql = "SELECT * FROM penyertaan WHERE idaktiviti = ? AND idpeserta = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $idactivity, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if(mysqli_num_rows($result) > 0) {
            // User has already joined the activity
            header("location: activity_details.php?id=" . $idactivity ."&error=alreadyjoined");
            exit();
        }
        
        // Check if the user exists in the peserta table
        $sql = "SELECT * FROM peserta WHERE idpeserta = ? AND nama=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $id,$name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        echo mysqli_num_rows($result);
        
        if(mysqli_num_rows($result) > 0) {
            // User exists
            // Insert the user into the penyertaan table
            $sql = "INSERT INTO penyertaan (idaktiviti,idpeserta) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ss", $idactivity, $id);
            mysqli_stmt_execute($stmt);
            
            if(mysqli_stmt_affected_rows($stmt) > 0) {
                header("location: activity_details.php?id=" . $idactivity ."&error=none");
            } else {
                header("location: activity_details.php?id=" . $idactivity ."&error=sqlfailed");
            }
            
            mysqli_stmt_close($stmt);
        }
         else {
            // User does not exist
            header("location: activity_details.php?id=" . $idactivity ."&error=usernotfound");
            exit();
        }
        
    }
