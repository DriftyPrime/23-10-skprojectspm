<?php
if(isset($_POST["submit"])){
    $email=$_POST["email"];
    $pwd=$_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    echo $email;
    echo $pwd;
    loginUser($conn,$email,$pwd);
}else{
    header("location: ../loginpage.php");
    exit();
}
