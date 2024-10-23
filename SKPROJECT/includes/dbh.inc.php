
<?php

// Check for errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

$serverName ="localhost";
$dbUsername  ="root";
$dbPassword ="";
$dbName     ="skproject";

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

if($conn)
{
   
}else
{
    echo "Connection failed: " . mysqli_connect_error();
    // Additional information for debugging (optional):
    echo "<br> mysqli_connect_errno(): " . mysqli_connect_errno();
}

// Optional: Close the connection (recommended practice)



