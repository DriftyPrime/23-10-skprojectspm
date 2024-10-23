<?php 
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];
    $idrumahsukan = $_POST["idrumahsukan"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if(invalidEmail($email)!==false){
        header("location: ../signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd,$pwdrepeat)!==false){
        header("location: ../signup.php?error=passworddontmatch");
        exit();
    }
    if(emailexist($conn,$email)!==false){
        header("location: ../signup.php?error=emailalreadyexist");
        exit();
    }
    createuser($conn,$email,$pwd,$name,$idrumahsukan);
}elseif(isset($_POST["submit_admin"])){
    $name_admin = $_POST["name_admin"];
    $email_admin = $_POST["email_admin"];
    $pwd_admin = $_POST["pwd_admin"];
    $pwdrepeat_admin = $_POST["pwdrepeat_admin"]; 
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if(invalidEmail($email_admin)!==false){
        header("location: ../profile.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd_admin,$pwdrepeat_admin)!==false){
        header("location: ../profile.php?error=passworddontmatch");
        exit();
    }
    if(emailexist($conn,$email_admin)!==false){
        header("location: ../profile.php?error=emailalreadyexist");
        exit();
    }
    create_admin($conn, $name_admin, $email_admin, $pwd_admin, $pwdrepeat_admin);
}else{
    header("location: ../signup.php");
    exit();
}

