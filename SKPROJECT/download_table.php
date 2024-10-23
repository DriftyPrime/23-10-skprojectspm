<?php

    require_once 'includes/dbh.inc.php';
    
    $id=$_GET['id'];
    echo "<br>";
  
    $sql = "SELECT peserta.nama, rumahsukan.nama_rumahsukan, penyertaan.status_kehadiran
            FROM penyertaan
            INNER JOIN peserta ON penyertaan.idpeserta = peserta.idpeserta
            INNER JOIN rumahsukan ON peserta.idrumahsukan = rumahsukan.idrumahsukan
            WHERE penyertaan.idaktiviti = ?;";
   
    $stmt=mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    echo"<br>";
    $html="<table><tr><td>Name</td><td>Rumah Sukan</td><td>Status Kehadiran</td></tr>";
    echo "<br>";
    

    while($row = mysqli_fetch_assoc($result))
    {
        $html .='<tr><td>'.$row['nama'].'</td><td>'.$row['nama_rumahsukan'].'</td><td>'.$row['status_kehadiran'].'</td></tr>';
    }
    $html .= '</table>';

    header('Content-Type: application/xls');
    header('Content-Disposition: attachment; filename=laporan.xls');
    echo $html;
    



