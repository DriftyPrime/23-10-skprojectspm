<?php 
    function checkUserRumahsukan($conn, $id) {

        $sql = "SELECT * FROM peserta INNER JOIN rumahsukan ON peserta.idrumahsukan = rumahsukan.idrumahsukan WHERE idpeserta = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        $row=mysqli_fetch_assoc($result);
        return $row['nama_rumahsukan'];
        
    }