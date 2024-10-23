<?php
    function checkAdminOrUser($conn, $id) {

        $sql = "SELECT * FROM guru WHERE idguru=?";
        $stmt =mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        if (mysqli_num_rows($result) > 0) {
            return 'admin';
        }

    
        $sql = "SELECT * FROM peserta WHERE idpeserta = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
        if (mysqli_num_rows($result) > 0) {
            return 'user';
        } else {
            return 'none';
        }
    }
