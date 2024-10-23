<?php session_start();?>
<!DOCTYPE html>
<html>
    <link rel="stylesheet" href="css/style.css">
    <head>
        <meta charset="UTF-8">
        <title> Kehadiran Hari Sukan SMKSBS</title>
        <style>
            body
            {
                background-image: url("image/national-sports-day-illustration_23-2148993654.avif");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;
            }
            .font-size-button {
            margin: 5px;
            padding: 2px 20px; /* Added padding for a better look */
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 25px; /* Makes the button rounded */
            transition: background-color 0.3s; /* Optional: for smooth hover effect */

            
            }

            .font-size-button:hover {
                background-color: #45a049; /* Darker shade on hover */
            }

            

        </style>
    </head>
    <body>
      
        <ul class="nav">
            <div class="logo">
                <a href="index.php" style="text-decoration: none; color:#ffffff;"
                    onmouseover="this.style.color='#c1c1c1'"
                    onmouseout="this.style.color='#ffffff'">
                 HOME</a>
            </div> 
            <?php
                include_once'includes/dbh.inc.php';
                include_once'includes/checkadminoruser.php';

                if(isset($_SESSION["id"]))
                {
                    if(checkAdminOrUser($conn, $_SESSION["id"]) == 'admin')
                    {
                        echo '<li><a href="query.php">PESERTA</a></li>';
                        echo '<li><a href="upload.php">UPLOAD</a></li>';
                    }
                }

           
 
                
            ?>
            
            <li><a href="aktiviti.php">AKTIVITI</a></li>
            <li class="dropdown">
                <a href="javascript: void(0)" class="dropbtn">Akaun</a>
                <div class="dropdown-content">
                   <?php   
                        if(isset($_SESSION["id"]))
                        {
                            //logged in
                            echo"<a href='profile.php'>Profil</a>";
                            echo"<a href='includes/logout.php'>Log Out</a>";
                        }else
                        {
                            //not logged in
                            echo"<a href='loginpage.php'>Log In</a>";
                            echo"<a href='signup.php'>Daftar</a>";
                        }
                    ?>
                </div>
            </li>
        </ul>
        
        
        
    
    </body>
    <div class="font-size-buttons-container" style="position: fixed; bottom: 0px; font-size: 10px;">   
        <h1 style="font-size: 16px ;">Font Size:</h1>
        <button class="font-size-button" onclick="increaseFontSize()">+</button>
        <button class="font-size-button" onclick="decreaseFontSize()">-</button>
        <button class="font-size-button" onclick="resetFontSize()">Reset</button>
    </div>

    <script>
        // Function to increase font size for the entire page
        function increaseFontSize() {
            var body = document.body;
            var currentFontSize = window.getComputedStyle(body).fontSize;
            var newFontSize = parseFloat(currentFontSize) + 2; // Increase by 2px
            body.style.fontSize = newFontSize + "px";
        }

        // Function to decrease font size for the entire page
        function decreaseFontSize() {
            var body = document.body;
            var currentFontSize = window.getComputedStyle(body).fontSize;
            var newFontSize = parseFloat(currentFontSize) - 2; // Decrease by 2px
            body.style.fontSize = newFontSize + "px";
        }

        // Function to reset font size for the entire page
        function resetFontSize() {
            var body = document.body;
            body.style.fontSize = "16px";
        }
    </script>
</html>