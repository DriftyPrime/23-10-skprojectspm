<?php
    session_start();
    
    $idpeserta=$_SESSION["id"];
    require_once 'dbh.inc.php';
    $function = $_POST["function"];
    if($function == "editpn")
    {
        $nombortelefon = $_POST["nombortelefon"];
        $sql="UPDATE  peserta SET nombor_telefon = ? WHERE idpeserta = ?";
        $stmt=mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $nombortelefon, $idpeserta);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../profile.php?error=pntukar");

    }elseif($function == "editname")
    {
        $name = $_POST["name"];
        $sql="UPDATE  peserta SET nama = ? WHERE idpeserta = ?";
        $stmt=mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $name, $idpeserta);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../profile.php?error=namatukar");
    }
    
    