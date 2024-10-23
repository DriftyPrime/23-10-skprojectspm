<?php   
    
    require_once 'includes/dbh.inc.php';

    

    $id = htmlspecialchars($_GET["id"]);
    $status = htmlspecialchars($_GET["status"]);
    $idpeserta = htmlspecialchars($_GET["idpeserta"]);

    
    echo $id."<br>";
    echo $status."<br>";
    echo $idpeserta;
    if($status == "Hadir"){
        $status = "Tidak Hadir";
        
        update_kehadiran($conn, $id, $status, $idpeserta);
    }else if($status =="Tidak Hadir"){
        $status = "Hadir";
        update_kehadiran($conn, $id, $status, $idpeserta);
        
    }else if($status=="delete"){
        delete_kehadiran($conn, $id, $idpeserta);
    }else{
        $status="Hadir";
        update_kehadiran($conn, $id, $status, $idpeserta);
    }
    


    function update_kehadiran($conn, $id, $status, $idpeserta) {
        
        $sql = "UPDATE penyertaan SET status_kehadiran = ? WHERE idaktiviti = ? AND idpeserta = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('Prepare failed: ' . mysqli_error($conn));
        }

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'sis', $status, $id,$idpeserta);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Attendance updated successfully.";
        } else {
            echo "Failed to update attendance.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
        header("Location: activity_details.php?id=".$id);
    }

    function delete_kehadiran($conn,$id,$idpeserta)
    {
        $sql = "DELETE FROM penyertaan WHERE idaktiviti = ? AND idpeserta = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            die('Prepare failed: ' . mysqli_error($conn));
        }

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, 'is',$id,$idpeserta);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Attendance deleted successfully.";
        } else {
            echo "Failed to delete attendance.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
        header("Location: activity_details.php?id=".$id);
    }
   
