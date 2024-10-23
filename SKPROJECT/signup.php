<?php include'header.php'?>

<section>
   
    <style>

        .form{
        width: 250px;
        height: auto;   
        color: #fff;
        background: linear-gradient(to top, rgba(0,0,0,0.8)50%,rgba(0,0,0,0.8)50%);
        position: absolute;
        top: 50%;
        left: 50%;
        margin-top: 50px;
        transform: translate(-50%,-50%);
        border-radius: 10px;
        padding: 40px 25px;
       }
       .form h1
       {
           width: 220px;
           text-align: center;
           padding-left: 11px;
           margin-bottom: 20px;
           font-size: 35px;
           color: white;
       }

       .form input
       {
        width: 100%;
        height: 25px;
        padding-left: 3px;
        padding-top: 10px;
        padding-bottom: 15px;
        margin-bottom: 15px;
        background: transparent;
        border-bottom: 1px solid #fff;
        border-top: none;
        border-right: none;
        border-left: none;
        color: #fff;
        font-size: 15px;
        outline: none;
       }
       .form select
       {
        width: 100%;
        background: transparent;
        background-color: grey;
        color: #fff;
        font-size: 15px;
        border-radius: 4px;
        height: 25px;
        color: white;
        border: none;
        padding-bottom: 10px;
        margin-bottom: 15px;
       }
       .form button
       {
        width: 100%;
        height: 40px;
        background-color: green;
        font-size: 18px;
        border-radius: 10px;
        border: none;
        outline: none;
        color: white;
        cursor: pointer;
        margin-bottom: 25px;
       }
       
       .form button:hover
       {
        color: grey;
       }

       .form a 
       {
        text-decoration: none;

        color: cyan;
       }
       .form a:hover
       {
        color: purple;
       }
       .form p
       {
        color : red;
       }

    </style>
    <script>
        
    </script>
    <div class="form">
        <h1>Sign Up</h1>
        <form action="includes/signup.inc.php" method="post">    
                <input type="text" class="form-control mb-2" placeholder="Masukkan nama" name="name" required/>
                <input type="text" class="form-control mb-2" placeholder="Email/ID" name="email" required/>
                <input type="password" class="form-control mb-2" placeholder="Masukkan Password" name="pwd"required/>
                <input type="password" class="form-control mb-2" placeholder="Masukkan Password" name="pwdrepeat"required/> 
                <select name="idrumahsukan">
                    <option value="1">Ruby</option>
                    <option value="2">Emerald</option>
                    <option value="3">Topaz</option>
                    <option value="4">Saphire</option>
                    <option value="5">Amethyst</option>
                </select>
                <button type="submit" name="submit" class="btn btn-primary">Sign Up</button><br>
                <label>Already have an account?</label>
                <a href="loginpage.php" style="text-decoration: none">Login</a>

                <?php
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    if(isset($_GET["error"]))
                    {
                        if($_GET["error"]== "emptyinput")
                        {
                            echo"<p>Fill In all fields!</p>";
                        }else if($_GET["error"]== "invalidemail")
                        {   
                            echo"<script>alert('choose a proper email')</script>";
                        }else if($_GET["error"]== "passworddontmatch")
                        {
                            echo"<p>password doesn't match</p>";
                        }else if($_GET["error"]== "stmtfailed")
                        {
                            echo"<p>something went wrong,try again</p>";
                        }else if($_GET["error"]== "emailalreadyexist")
                        {
                            echo"<p>email already taken</p>";
                        }else if($_GET["error"]== "none")
                        {
                            echo"<script>alert('Sign Up Successful')
                            window.location.href='loginpage.php'</script>";
                            
                        }
                    }
                ?>
        </form>  
    </div>       
</section>

