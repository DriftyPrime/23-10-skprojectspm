<?php include_once 'dbh.inc.php'; ?>
<?php

if(isset($_POST["delete"]))
{
    $id = $_POST["id"];
    $sql = "DELETE FROM penyertaan WHERE idaktiviti = $id";
    $sql2="DELETE FROM aktiviti WHERE idaktiviti = $id";
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);
    header("Location: ../delete_activity.php?error=none");
}