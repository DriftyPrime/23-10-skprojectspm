<?php


    function emptyInputSignup($name,$email,$pwd,$pwdrepeat)
    {
        if(empty($name) || empty($email) || empty($pwd) || empty($pwdrepeat))
        {
            $result = true;
        }else
        {
            $result = false;
        }
        return $result;
    }
    function invalidEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $result = true;
        }else
        {
            $result = false;
        }
        return $result;
    }

    function pwdMatch($pwd,$pwdrepeat)
    {
        if($pwd !== $pwdrepeat)
        {
            $result = true;
        }else
        {
            $result = false;
        }
        return $result;
    }
    
    function emailexist($conn,$email){
        $sql ="SELECT * FROM peserta WHERE idpeserta=?; ";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt,"s" , $email); 
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }else{
            $sql ="SELECT * FROM guru WHERE idguru=?; ";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql)){
                header("location: ../signup.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt,"s" , $email); 
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($resultData)){
                return $row;
            }else{
                $result=false;
                return $result;
            }
        }
        mysqli_stmt_close($stmt);
    }

    


    function createuser($conn,$email,$pwd,$name,$idrumahsukan){
        $sql ="INSERT INTO `peserta` (`idpeserta`, `password`, `nama`,`idrumahsukan`) VALUES(?,?,?,?); ";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../signup.php?error=stmtfailed");
            echo"error creating uesr";
            exit();
        }
        $hashedPwd =(password_hash($pwd,PASSWORD_DEFAULT));                                 //encryipt pass
        mysqli_stmt_bind_param($stmt,"ssss",$email,$hashedPwd,$name,$idrumahsukan);        //4 s because there is 4 data
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
        exit();
    }
    function create_admin($conn, $name_admin, $email_admin, $pwd_admin, $pwdrepeat_admin)
    {
        $sql ="INSERT INTO `guru` (`idguru`, `password`, `nama`) VALUES(?,?,?); ";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("location: ../profile.php?error=stmtfailed");
            echo"error creating uesr";
            exit();
        }
        $hashedPwd =(password_hash($pwd_admin,PASSWORD_DEFAULT));                                 //encryipt pass
        mysqli_stmt_bind_param($stmt,"sss",$email_admin,$hashedPwd,$name_admin);        
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../profile.php?error=none");
        exit(); 
    }

    function emptyInputLogin($email,$pwd)
    {
        if(empty($email) || empty($pwd))
        {
            $result = true;
        }else
        {
            $result = false;
        }
        return $result;
    }
   
    function loginUser($conn, $email, $pwd){
        $emailExists = emailexist($conn, $email);
        if ($emailExists === false) {
            header("location: ../loginpage.php?error=emaildoesntexist");
            exit();
        }
        $id = $emailExists["idguru"] ?? $emailExists["idpeserta"];
        $dbPwd = $emailExists["password"];
        $pwdHashed = $emailExists["password"];
        if ($dbPwd === $pwd) {
            session_start();
            $_SESSION["id"] = $id;
            header("location: ../loginpage.php?error=none");
            exit();
        } else {
            $checkPwd = password_verify($pwd, $pwdHashed);
            if ($checkPwd === false) {
                header("location: ../loginpage.php?error=wrongpassword");
                exit();
            } else if ($checkPwd === true) {
                session_start();
                $_SESSION["id"] = $id;
                header("location: ../loginpage.php?error=none");
                exit();
            }
        }
    }





    

