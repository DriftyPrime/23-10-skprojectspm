<?php
    session_start();
    
    require_once 'includes/dbh.inc.php';

    $sql="SELECT nama_aktiviti,masa,status_kehadiran FROM penyertaan JOIN aktiviti ON penyertaan.idaktiviti = aktiviti.idaktiviti WHERE idpeserta = ?;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $html="<table><tr><td>Name</td><td>Masa</td><td>Status Kehadiran</td></tr>";
    while($row = mysqli_fetch_assoc($result))
    {
        $html.='<tr><td>'.$row['nama_aktiviti'].'</td><td>'.$row['masa'].'</td><td>'.$row['status_kehadiran'].'</td></tr>';
    }
    $html .= '</table>';



    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=laporan.xls');
    echo $html;

        
       
    