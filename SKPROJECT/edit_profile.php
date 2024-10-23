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
    <?php 
      
        $function = $_GET['function'];
        if($function == 'editname')
        {
            
            echo "
            <div class=\"form\">
                <h1>Edit Profil</h1>
                <form action=\"includes/edit_profile_function.php\" method=\"POST\">
                    <input type=\"hidden\" name=\"function\" value=\"$_GET[function]\">
                    <input type=\"text\" name=\"name\" placeholder=\"Nama Baharu\" required><br>
                    <button type=\"submit\" name=\"submit\">Tukar</button>
                </form>  
            </div>
            ";
        }
        elseif($function == 'editpn')
        {
            echo"
            <div class=\"form\">
                <h1>Edit Profil</h1>
                <form action=\"includes/edit_profile_function.php\" method=\"POST\">
                    <input type=\"hidden\" name=\"function\" value=\"$_GET[function]\">
                    <input type=\"text\" name=\"nombortelefon\" placeholder=\"Nombor Telefon Baharu\" required><br>
                    <button type=\"submit\" name=\"submit\">Tukar</button>
                </form>  
            </div>
            ";
        }
    ?>

</section>