<?php include 'dbh.inc.php'?>
<?php 
if(isset($_POST["submit"]))
{
    $activity = $_POST["activity"];
    $date = $_POST["date"];
    $idguru = $_POST["idguru"];
    $sql = "INSERT INTO aktiviti (nama_aktiviti, masa, idguru) VALUES ('$activity', '$date', '$idguru')";
    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header("Location: ../add_activity.php?error=none");
        exit();
    }
    else    
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}